<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\User;
use App\Models\Booking;
use App\Models\Reminder;
use App\Models\User as ModelsUser;
use Carbon\Carbon;


class CarController extends Controller
{

    private $filters = [];
    // if ($request->hasFile('images')) {
    //     foreach ($request->file('images') as $image) {
    //         $car->addMedia($image)->toMediaCollection('cars');
    //     }
    // }

    public function updateMaintenance(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);
        $partName = $request->part_name;

        // Find the reminder for the specific part
        $reminder = Reminder::where('car_id', $carId)
            ->where('part_name', $partName)
            ->first();

        if ($reminder) {
            $nextInterval = $reminder->maintenance_interval; // Get interval from DB (3, 6, 12 months)

            $reminder->update([
                'next_reminder_date' => Carbon::now()->addMonths($nextInterval),
                'next_reminder_km' => $car->current_km + (10000 * ($nextInterval / 6)), // Adjusted based on months
                'notified' => false
            ]);
        }

        return response()->json(['message' => 'Maintenance updated, reminder reset']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->setFilters();
        $data['filters'] = $this->filters;
        $data['rows'] = CarResource::collection(Car::paginate(20));
        $data['page_title'] = "Cars";
        $data['breadcrumb'] = '';
        return view("admin.car.index", $data);
    }

    public function create()
    {
        return view("admin.car.create", $this->getLookup());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        // dd($data);
        $car = Car::create($data);
        if ($request->hasFile('main')) { //name = images

            $image = $request->file('main');
            $car->addMedia($image)->toMediaCollection('mainImage');
        }

        if ($request->hasFile('gallery')) { //name = images

            foreach ($request->file('gallery') as $image) {
                $car->addMedia($image)->toMediaCollection('gallery');
            }
        }
        // dd($car);
        return redirect()->route("admin.car.index");
    }


    public function edit(Car $car)
    {
        $data["row"] = $car;
        $data = array_merge($data, $this->getLookup());
        return view("admin.car.edit", $data);
    }



    // public function processSell_2(Request $request, $carId)
    // {
    //     $car = Car::findOrFail($carId);

    //     // Validate the selected user
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     // Assign the car to the new owner
    //     $car->user_id = $request->user_id;
    //     $car->is_sold = true; // Update status to sold
    //     $car->save();
    //     $id = $request->user_id;
    //     $userName = ModelsUser::find($id)->name;

    //     // return view("admin.car.idex","car sold to {$userName}");
    //     flash()->success("Sold Succefully");
    //     return redirect()->route("admin.car.index");


    //     //return response()->json(['message' => 'Car sold successfully!']);
    // }
    public function processSell(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);

        // Validate the selected user
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Assign the car to the new owner
        $car->user_id = $request->user_id;
        $car->is_sold = true; // Update status to sold
        $car->save();

        // Get the current date to start maintenance reminder after selling
        $soldDate = Carbon::now();

        // Loop over all parts and set maintenance reminders based on selling date

        $this->setMaintenanceReminders($car, $soldDate);

        flash()->success("Car sold and maintenance reminders updated.");
        return redirect()->route("admin.car.index");
    }


    public function getSellPage(Car $car)
    {

        $users = ModelsUser::all();

        return view("admin.car.sell", ['car' => $car, 'users' => $users]);
        // return view("admin.car.sell", compact('car','users'));
    }

    public function getBookPage(Car $car)
    {
        $users = ModelsUser::all();
        return view("admin.car.book", ['car' => $car, 'users' => $users]);
    }

    public function processBook(Request $request, $carId)
    {
        if ($request->amount < 100) {
            flash()->error("Deposit amount must be at least 100.");
            return back();
        }
        $car = Car::findOrFail($carId);
        $car->is_booked = true;
        $car->save();
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'car_id' => $carId,
            'deposit_amount' => $request->amount,
            'status' => 'Booked',
        ]);
        flash()->success("Booked Succefully");
        return redirect()->route("admin.car.index");
    }

    public function cancelBookPage(Car $car)
    {
        $users = ModelsUser::all();
        return view("admin.car.cancel", ['car' => $car, 'users' => $users]);
    }
    public function cancelBooking(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);

        $booking = Booking::where('car_id', $carId)
            ->whereNull('cancelled_at')
            ->with('user') // eager load user
            ->latest()
            ->first();

        if (!$booking) {
            flash()->warning('No active booking found for this car.');
            return redirect()->back();
        }

        $userEmail = $booking->user->email ?? 'Unknown';

        $booking->cancelled_at = now();
        $booking->status = 'Cancelled';
        $booking->save();

        $car->is_booked = false;
        $car->save();

        flash()->success("Booking cancelled successfully. User: $userEmail");
        return redirect()->route('admin.car.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        // $userEmail = Booking::where('user_id', $user->id)->whereNull('cancelled_at')->with('user')->latest()->first();
        // if  ($userEmail) {
        //     $userEmail = $userEmail->user->email;
        // }
        // $deposit = Booking::where('car_id', $car->id)->whereNull('cancelled_at')->with('user')->latest()->first();

        // return view("admin.car.view", compact('car', 'userEmail'));
        // return redirect()->route("admin.car.view",['car'=> $id]);
        $latestBooking = Booking::where('car_id', $car->id)
            ->whereNull('cancelled_at')
            ->with('user') // eager load user to get email
            ->latest()
            ->first();

        // Extract data safely
        $userEmail = $latestBooking?->user?->email ?? null;
        $depositAmount = $latestBooking?->deposit_amount ?? null;

        return view("admin.car.view", compact('car', 'userEmail', 'depositAmount'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();
        if ($request->hasFile('main')) { //name = images

            // $image = $request->file('main');
            $car->clearMediaCollection('main');
            // $car->addMedia($image)->toMediaCollection('mainImage');
            $car->addMedia($request->file('main'))->toMediaCollection('mainImage');
        }

        if ($request->hasFile('gallery')) {
            $car->clearMediaCollection('gallery');
            foreach ($request->file('gallery') as $image) {
                $car->addMedia($image)->toMediaCollection('gallery');
            }
        }
        $car->update($data);
        return redirect()->route("admin.car.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        flash()->success("Deleted Succefully");
        return redirect()->back();
    }

    public function setFilters()
    {
        $this->filters[] = [
            'name' => 'name',
            'type' => 'input',
            'trans' => true,
            'value' => request()->get('name'),
            'attributes' => [
                'class' => 'form-control',
                'label' => "Type",
                'placeholder' => "name",
            ]
        ];
    }


    private function getLookup()
    {
        return [
            "suppliers" => Supplier::pluck('lname', 'id'),
            "branches" => Branch::pluck('name', 'id'),
            "brands" => Brand::pluck('name', 'id'),
            "categories" => Category::pluck('type', 'id'),
        ];
    }

    public function setMaintenanceReminders(Car $car)
    {
        // Define fixed intervals and units for maintenance parts
        $maintenanceParts = [
            'for_me' => [
                'interval' => 1, // 1 min
                'unit' => 'minute', // Specify the unit as 'minute'
            ],
            'Oil Filter' => [
                'interval' => 3, // 3 months
                'unit' => 'month', // Specify the unit as 'month'
            ],
            'Brake Pads' => [
                'interval' => 12, // 12 months
                'unit' => 'month', // Specify the unit as 'month'
            ],
            'Tires' => [
                'interval' => 6, // 6 months
                'unit' => 'month', // Specify the unit as 'month'
            ],
            'Air Filter' => [
                'interval' => 6, // 6 months
                'unit' => 'month', // Specify the unit as 'month'
            ],
            'Battery' => [
                'interval' => 12, // 12 months
                'unit' => 'month', // Specify the unit as 'month'
            ],
        ];

        // Loop through each maintenance part and set reminder
        foreach ($maintenanceParts as $partName => $data) {
            $interval = $data['interval'];
            $unit = $data['unit'];

            // Determine the next reminder date based on the unit
            if ($unit === 'minute') {
                $nextReminderDate = Carbon::now()->addMinutes($interval);
            } elseif ($unit === 'month') {
                $nextReminderDate = Carbon::now()->addMonths($interval);
            }

            Reminder::create([
                'car_id' => $car->id,
                'part_name' => $partName,
                'maintenance_interval' => $interval,
                'next_reminder_date' => $nextReminderDate,
                'reminder_type' => 'time', // You can adjust this to 'usage' or 'condition' based on your needs
                'notified' => false,
            ]);
        }
    }
}
