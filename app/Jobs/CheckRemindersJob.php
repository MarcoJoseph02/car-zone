<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\Reminder;

class CheckRemindersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reminders = Reminder::where(function ($query) {
            $query->where('reminder_type', 'time')
                  ->where('next_reminder_date', '<=', Carbon::today());
        })->orWhere(function ($query) {
            $query->where('reminder_type', 'usage')
                  ->whereColumn('next_reminder_km', '<=', 'cars.current_km');
        })->where('notified', false)->get();

        foreach ($reminders as $reminder) {
            Mail::to($reminder->car->user->email)->send(new ReminderEmail($reminder));
            $reminder->update(['notified' => true]);
        }
    }
}
