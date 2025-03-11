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
use App\Models\Reminder;
use App\Models\User as ModelsUser;
use Carbon\Carbon;

class CarController extends Controller
{

    private $filters = [];

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
        // dd($car);
        return redirect()->route("admin.car.index");
    }


    public function edit(Car $car)
    {
        $data["row"] = $car;
        $data = array_merge($data, $this->getLookup());
        return view("admin.car.edit", $data);
    }



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
        $id = $request->user_id;
        $userName = ModelsUser::find($id)->name;

        // return view("admin.car.idex","car sold to {$userName}");
        flash()->success("Sold Succefully");
        return redirect()->route("admin.car.index");


        //return response()->json(['message' => 'Car sold successfully!']);
    }

    public function getSellPage(Car $car){

        $users = ModelsUser::all();
        
        return view("admin.car.sell",['car' => $car, 'users' => $users]);
        // return view("admin.car.sell", compact('car','users'));
    }

    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return new CarResource($car);
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
        $car->update($data);
        return redirect()->route("admin.brand.index");
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
    // public function sell(Request $request, Car $car)
    // {
    //     $car->update(['is_sold' => true,'user_id'=>$request->user_id]);
    //     flash()->success("Sold Succefully");
    //     return redirect()->back();
    // }

    private function getLookup()
    {
        return [
            "suppliers" => Supplier::pluck('lname', 'id'),
            "branches" => Branch::pluck('name', 'id'),
            "brands" => Brand::pluck('name', 'id'),
            "categories" => Category::pluck('type', 'id'),
        ];
    }
}
