<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use App\Console\CheckRemindersJob;
use App\Jobs\CheckRemindersJob;
use App\Console\Mail;
use App\Console\FacadesMail;
use Illuminate\Support\Facades\Mail as SupportFacadesMail;
use App\Models\Reminder;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->job(new CheckRemindersJob)->daily();

        // $schedule->command('inspire')->hourly();
        // $schedule->job(new CheckRemindersJob)->daily();
        $schedule->call(function () {
            $reminders = Reminder::whereDate('next_reminder_date', now()->toDateString())
                ->where('notified', false)
                ->get();
    
            foreach ($reminders as $reminder) {
                //Mail::to($reminder->email)->send(new  \App\Mail\MaintenanceReminderMail($reminder
                SupportFacadesMail::to($reminder->email)->send(new \App\Mail\MaintenanceReminderMail($reminder));
    
                // Mark as notified
                $reminder->update(['notified' => true]);
            }
        })->dailyAt('08:00'); // Send emails every day at 8 AM

    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
