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
        $request->validate([
            'car_id' => 'required|exists:cars,id',
        ]);

        $maintenanceParts = [
            'for_me' => [
                'interval' => 1, // 1 hour
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
        foreach ($maintenanceParts as $partName => $partData) {
            $interval = $partData['interval'];
            $unit = $partData['unit'];

            // Calculate the next reminder date based on unit
            if ($unit === 'minute') {
                $nextReminderDate = now()->addMinutes($interval);
            } elseif ($unit === 'month') {
                $nextReminderDate = now()->addMonths($interval);
            }
            // $interval = Reminder::getIntervalForPart($request->part_name); do not need to use it bec. we already have the interval in the array


            // Save the reminder to the database
            Reminder::create([
                'car_id' => $request->car_id,
                'part_name' => $partName,
                'maintenance_interval' => $interval,
                'next_reminder_date' => $nextReminderDate,
                'reminder_type' => 'time', // Assuming reminder type is 'time'
                'notified' => false, // Initially, not notified
            ]);
        }

        return response()->json(['message' => 'Reminder added successfully!'], 201);
    }


    public function sendMaintenanceReminder()
    {
        // Get all reminders that are due for sending (based on the 'next_reminder_date')
        $reminders = Reminder::whereNotNull('next_reminder_date') // Ensure that the reminder date exists
            ->where('next_reminder_date', '<=', now()) // Ensure that the reminder time has arrived
            ->get();

        foreach ($reminders as $reminder) {
            $intervalInMonths = $reminder->maintenance_interval;
            $lastNotifiedAt = $reminder->last_notified_at;

            // Check if enough time has passed since the last reminder
            if ($lastNotifiedAt === null || $lastNotifiedAt->diffInMonths(now()) >= $intervalInMonths) {
                // Send the maintenance reminder email
                Mail::to($reminder->car->user->email)->send(new MaintenanceReminderMail($reminder));

                // Update the reminder with the new last notified time
                $reminder->update([
                    'last_notified_at' => now(), // Update the last notification timestamp
                    'notified' => true, // Mark as notified
                ]);

                // Update the next reminder date based on the maintenance interval
                $nextReminderDate = now()->addMonths($reminder->maintenance_interval);
                $reminder->update([
                    'next_reminder_date' => $nextReminderDate,
                ]);
            }
        }

        return response()->json(['message' => 'Maintenance reminders sent successfully!'], 200);
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
