<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use App\Models\Reminder as ReminderModel;
// use App\Jobs\Mail;
use App\Mail\PaymentSuccessMail;
use App\Mail\ReminderEmail;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;


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
        
    }
    public function paymentIntentSucceeded(Request $request)
{
    // Assume you validated the Stripe webhook or payment intent status

    $user = auth()->user();  // or fetch user by payment info
    $amount = $request->amount; // e.g., 100.00 EGP
    $paymentIntentId = $request->payment_intent_id;

    $paymentData = [
        'user_name' => $user->name,
        'amount' => $amount,
        'payment_id' => $paymentIntentId,
    ];

    Mail::to($user->email)->send(new PaymentSuccessMail($paymentData));

    return response()->json(['message' => 'Payment confirmed and email sent.']);
}

}
