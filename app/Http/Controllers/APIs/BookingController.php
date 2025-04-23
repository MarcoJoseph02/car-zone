<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use App\Notifications\BookingCancelled;



class BookingController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'car_id' => 'required|exists:cars,id',
        ]);

        return DB::transaction(function () use ($request) {
            $car = Car::where('id', $request->car_id)
                ->where('is_available', true)
                ->lockForUpdate()
                ->firstOrFail();

            $depositAmount = $car->price * 0.10;

            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $depositAmount * 100,
                'currency' => 'usd',
                'capture_method' => 'manual',
                'metadata' => [
                    'user_id' => auth()->id(),
                    'car_id' => $car->id,
                    'type' => 'deposit'
                ],
            ]);

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'car_id' => $car->id,
                'deposit_amount' => $depositAmount,
                'payment_intent_id' => $paymentIntent->id,
                'status' => 'pending_payment',
                'starts_at' => now(),
                'ends_at' => now()->addDays(3),
            ]);

            $car->update(['is_available' => false]);
            $this->setMaintenanceReminders($car);

            return response()->json([
                'message' => 'Booking created. Payment required.',
                'payment_intent_client_secret' => $paymentIntent->client_secret,
                'deposit_amount' => $depositAmount,
                'booking_id' => $booking->id,
            ], 201);
        });
    }
    public function setMaintenanceReminders(Car $car)
    {
        // Define fixed intervals and units for maintenance parts
        $maintenanceParts = [
            'for_me' => [
                'interval' => 1, // 1 min
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

        // Loop through each maintenance part and set reminder
        foreach ($maintenanceParts as $partName => $data) {
            $interval = $data['interval'];
            $unit = $data['unit'];

            // Determine the next reminder date based on the unit
            if ($unit === 'minute') {
                $nextReminderDate = Carbon::now()->addMinutes($interval);
            } elseif ($unit === 'month') {
                $nextReminderDate = Carbon::now()->addMonths($interval);
            }

            Reminder::create([
                'car_id' => $car->id,
                'part_name' => $partName,
                'maintenance_interval' => $interval,
                'next_reminder_date' => $nextReminderDate,
                'reminder_type' => 'time', // You can adjust this to 'usage' or 'condition' based on your needs
                'notified' => false,
            ]);
        }
    }


    
    // Refund the booking
    // public function processRefund($bookingId)//4klha mlha4 lazma
    // {
    //     if (!auth()->check()) {
    //         return response()->json(['message' => 'You must be logged in to book a car.'], 403);
    //     }
    //     // Retrieve the booking using the booking ID
    //     $booking = Booking::findOrFail($bookingId);

    //     $hoursSinceStart = $this->getHoursSinceStart($booking);

    //     if ($hoursSinceStart <= 24) {
    //         $refundAmount = $booking->deposit_amount;
    //     } elseif ($hoursSinceStart <= 72) {
    //         $refundAmount = $booking->deposit_amount * 0.8;
    //     } else {
    //         $refundAmount = 0;
    //     }


    //     // Update the booking with the refund amount
    //     $booking->update([
    //         'refund_processed' => true, // Mark the refund as processed
    //         'refund_amount' => $refundAmount, // Set the calculated refund amount
    //     ]);

    //     return response()->json([
    //         'message' => 'Refund processed successfully.',
    //         'refund_amount' => $refundAmount, // Return the refund amount to the user
    //     ]);
    // }


    public function cancel(Booking $booking)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to book a car.'], 403);
        }
        if ($booking->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized: You can only cancel your own bookings.'], 403);
        }
    
        if ($booking->status === 'completed') {
            return response()->json(['message' => 'This booking is already completed and cannot be cancelled.'], 400);
        }
        if ($booking->status === 'cancelled') {
            return response()->json(['message' => 'Booking already cancelled'], 400);
        }

        // $hoursSinceBooking = $booking->created_at->diffInHours(now());
        $hoursSinceStart = $this->getHoursSinceStart($booking);


        if ($hoursSinceStart <= 24) {

            $refundAmount = $booking->deposit_paid ? $booking->deposit_amount : 0;
        } elseif ($hoursSinceStart <= 72) {

            $refundAmount = $booking->deposit_paid ? $booking->deposit_amount * 0.8 : 0;
        } else {

            $refundAmount = 0;
        }

        if ($booking->deposit_paid && $refundAmount > 0) {
            $this->processStripeRefund($booking, $refundAmount);
        }

        $booking->car()->update(['is_available' => true]);
        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'refund_processed' => true,
            'refund_amount' => $refundAmount,
        ]);

        // Send email notification
        //  logger(auth()->user());
         $user = User::find(auth()->id());
         $user->notify(new BookingCancelled($booking));

        // if ($user && method_exists($user, 'notify')) {
        //     $user->notify(new BookingCancelled($booking));
        // } else {
        //     logger('Notify method not found or user is null');
        // }


        return response()->json([
            'message' => $hoursSinceStart <= 24
                ? 'Full 10% refund processed'
                : '8% refund processed (2% fee kept)',
            'refund_amount' => $refundAmount,
        ]);
    }

    private function processStripeRefund($booking, $amount)
    {
        if ($amount <= 0 || !$booking->payment_intent_id) return;

        Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Refund::create([
            'payment_intent' => $booking->payment_intent_id,
            'amount' => $amount * 100,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function showRefundPolicy(Booking $booking)
    {
        // $hoursSinceBooking = $booking->created_at->diffInHours(now());
        //$hoursSinceBooking = $booking->starts_at->diffInHours(now());
        $hoursSinceStart = $this->getHoursSinceStart($booking);



        $refundPolicy = [
            'cancel_within_24h' => $hoursSinceStart <= 24,
            'cancel_before_72h' => $hoursSinceStart > 24 && $hoursSinceStart <= 72,
            'message' => $this->getRefundPolicyMessage($hoursSinceStart),
        ];

        return response()->json([
            'booking' => $booking,
            'refund_policy' => $refundPolicy,
        ]);
    }

    private function getRefundPolicyMessage($hours)
    {
        if ($hours <= 24) return "Cancel now for 100% refund";
        if ($hours <= 72) return "Cancel now for 8% refund (2% fee)";
        return "Deposit already charged - 8% refund available";
    }

    public function userBookings()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->with('car')->get();
        return response()->json($bookings);
    }


    private function getHoursSinceStart(Booking $booking): int
    {
        return $booking->starts_at->diffInHours(now());
    }

}
