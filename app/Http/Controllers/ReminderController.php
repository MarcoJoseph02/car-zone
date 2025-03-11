<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Mail\MaintenanceReminderMail;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{

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

        return response()->json(['message' => 'Maintenance updated, reminder reset', 200]);
    }



    public function sendReminderEmail($reminderId)
    {
        $reminder = Reminder::findOrFail($reminderId);

        // Send email to the car owner
        Mail::to($reminder->car->owner_email)->send(new MaintenanceReminderMail($reminder->part_name));
        Mail::to('marojojo707@gmail.com')->send(new MaintenanceReminderMail($reminder->part_name));

        return response()->json(['message' => 'Reminder email sent successfully!'], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get the maintenance interval based on part name
        $interval = Reminder::getIntervalForPart($request->part_name);

        // Calculate the next reminder date (current date + interval months)
        $nextReminderDate = now()->addMonths($interval);

        // Save to database
        Reminder::create([
            'car_id' => $request->car_id,
            'part_name' => $request->part_name,
            'maintenance_interval' => $interval,
            'next_reminder_date' => $nextReminderDate,
            'reminder_type' => 'time',
        ]);

        return response()->json(['message' => 'Reminder added successfully!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
