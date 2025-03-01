<?php

namespace App\Listeners;

use App\Events\CarPartServiced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Listeners\Reminder;
use Carbon\Carbon;

class UpdateReminderListener
{
    
    /**
     * Handle the event.
     *
     * @param  \App\Events\CarPartServiced  $event
     * @return void
     */
    public function handle(CarPartServiced $event)
    {
        $reminder = Reminder::where('car_id', $event->car->id)
                            ->where('part_name', $event->partName)
                            ->first();

        if ($reminder) {
            $reminder->update([
                'next_reminder_date' => Carbon::now()->addMonths(6),
                'next_reminder_km' => $event->car->current_km + 10000,
                'notified' => false
            ]);
        }
    }
}
