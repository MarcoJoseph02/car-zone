<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CarMaintenanceController extends Controller
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

        return response()->json(['message' => 'Maintenance updated, reminder reset']);
    }
}
