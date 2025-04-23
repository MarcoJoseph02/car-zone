<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Customer;

class ProcessDeposits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $bookings = Booking::where('deposit_paid', false)
            ->where('created_at', '<=', now()->subHours(72)) // 72-hour window
            ->where('status', '!=', 'cancelled') // Skip cancelled bookings
            ->get();

        foreach ($bookings as $booking) {
            try {
                // Charge 10% deposit
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $booking->deposit_amount * 100, // in cents
                    'currency' => 'usd',
                    'customer' => $booking->user->stripe_id, // Assume user has Stripe ID
                ]);

                $booking->update([
                    'deposit_paid' => true,
                    'deposit_charged_at' => now(),
                    'payment_intent_id' => $paymentIntent->id,
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to charge deposit for booking {$booking->id}: " . $e->getMessage());
            }
        }
    }
}
