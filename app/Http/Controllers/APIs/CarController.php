<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
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
use App\Mail\BookingDepositPaid;
use App\Models\Booking;
use App\Models\Reminder;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Json;

class CarController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return  CarResource::collection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCarRequest $request)
    {
        //

        $data = $request->validated();
        $car = Car::create($data);
        return new CarResource($car);
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
        return new CarResource($car);
    }

    public function processBook(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);
        $car->is_booked = true;
        $car->save();
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'car_id' => $carId,
            'deposit_amount' => $request->amount,
            'status' => 'Booked',
            'starts_at' => Carbon::now(),
            'ends_at' => now()->addDays(3),
        ]);
        
        Mail::to($booking->user->email)->send(new BookingDepositPaid($booking));//-----------------------------------------------------------------

        flash()->success("Booked Succefully");
        return response()->json($booking);
    }

    public function soldCarsWithBuyers()
    {
        $soldCars = Car::where('is_sold', true)
            ->with('user:id,name,email') // assuming each car belongs to a user
            ->get(['id', 'model', 'year', 'price', 'user_id']);

        return response()->json([
            'sold_cars' => $soldCars
        ]);
    }
}
