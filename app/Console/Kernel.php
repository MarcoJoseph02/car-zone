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
use App\Models\Booking;
use App\Models\Car;
// use DB;
use Illuminate\Support\Facades\DB;

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
        $schedule->command('process:deposits')->hourly();

        $schedule->call('App\Http\Controllers\ReminderController@sendMaintenanceReminder')
            ->daily();
        // $schedule->job(new CheckRemindersJob)->daily();

        // $schedule->command('inspire')->hourly();
        // $schedule->job(new CheckRemindersJob)->daily();

        // Check and expire unpaid bookings every 30 minutes

        $schedule->call(function () {
            $expired = Booking::where('status', 'pending_payment')
                ->where('created_at', '<', now()->subHours(72))
                ->get();

            DB::transaction(function () use ($expired) {
                foreach ($expired as $booking) {
                    // Free up the car
                    Car::where('id', $booking->car_id)
                        ->update(['is_available' => true]);

                    // Mark booking as expired
                    $booking->update([
                        'status' => 'expired',
                        'cancelled_at' => now()
                    ]);
                }
            });
        })->everyThirtyMinutes();

        // Send maintenance reminder emails
        $schedule->call(function () {

            $reminders = Reminder::whereDate('next_reminder_date', now()->toDateString())
                ->where('notified', false)
                ->get();

            // dd($reminders);

            foreach ($reminders as $reminder) {
                //Mail::to($reminder->email)->send(new  \App\Mail\MaintenanceReminderMail($reminder
                SupportFacadesMail::to($reminder->email)->send(new \App\Mail\MaintenanceReminderMail($reminder));
                echo "Email sent to " . $reminder->email . " for car " . $reminder->car->name . " on " . now()->toDateString() . "\n";
                // Mark as notified
                $reminder->update(['notified' => true]);
            }
        })->everyMinute(); // Send emails every day at 8 AM

    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
