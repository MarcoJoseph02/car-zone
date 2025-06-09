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
use Stripe\PaymentIntent;
use Stripe\Refund;


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
                'currency' => 'egp',
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
            
            

            return response()->json([
                'message' => 'Booking created. Payment required.',
                'payment_intent_client_secret' => $paymentIntent->client_secret,
                'deposit_amount' => $depositAmount,
                'booking_id' => $booking->id,
                'clientSecret' => $paymentIntent->client_secret,
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
        // if (in_array($booking->status, ['completed', 'cancelled'])) {
        //     return response()->json(['message' => 'Booking already ' . $booking->status . '.'], 400);
        // }

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

        $user = User::find(auth()->id());
        $user->notify(new BookingCancelled($booking));




        return response()->json([
            'message' => $hoursSinceStart <= 24
                ? 'Full 10% refund processed'
                : '8% refund processed (2% fee kept)',
            'refund_amount' => $refundAmount,
        ]);
    }

    public function processStripeRefund(Booking $booking, float $amount)
    {
        if (!$booking->payment_intent_id) {
            logger()->warning("Missing payment_intent_id for booking ID: {$booking->id}");
            return response()->json([
                'message' => 'Refund failed: missing payment intent',
            ], 400);
        }

        if ($amount <= 0) {
            return response()->json([
                'message' => 'Refund failed: invalid refund amount',
            ], 400);
        }

        Stripe::setApiKey(config('services.stripe.secret')); // ✅ config preferred

        try {
            $refund = Refund::create([
                'payment_intent' => $booking->payment_intent_id,
                'amount' => intval(round($amount * 100)), // safer
            ]);

            return response()->json([
                'message' => 'Refund successful',
                'refund' => $refund,
            ]);
        } catch (\Exception $e) {
            logger()->error("Refund failed: " . $e->getMessage());
            return response()->json([
                'message' => 'Refund failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function createPaymentIntent(Request $request) //new
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:1',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => intval($request->amount * 100), // amount in cents
            'currency' => 'egp',
            'metadata' => [
                'booking_id' => $request->booking_id,
            ],
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
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

    private function getRefundPolicyMessage($hours)
    {
        if ($hours <= 24) return "Cancel now for 100% refund";
        if ($hours <= 72) return "Cancel now for 8% refund (2% fee)";
        return "No refund - more than 72 hours passed";
    }


    public function processBooking(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);

        if ($car->is_booked || !$car->is_available) {
            return response()->json(['message' => 'Car is not available for booking.'], 400);
        }

        $depositAmount = round($car->price * 0.10, 2);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => intval($depositAmount * 100), // in cents
            'currency' => 'egp',
            'capture_method' => 'manual',
            'metadata' => [
                'car_id' => $car->id,
                'user_id' => auth()->id(),
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

        // Reminder setup if needed
        $this->setMaintenanceReminders($car);

        return response()->json([
            'message' => 'Booking created. Payment required.',
            'clientSecret' => $paymentIntent->client_secret,
            'booking_id' => $booking->id,
            'deposit_amount' => $depositAmount,
        ], 201);
    }

    public function capturePayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $booking = Booking::where('id', $request->booking_id)
            ->whereNotNull('payment_intent_id')
            ->firstOrFail();

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::retrieve($booking->payment_intent_id);

        $intent->capture(); // this is where money is pulled from card

        $booking->update(['status' => 'Booked']);
        return response()->json(['message' => 'Payment captured & booking confirmed.']);
    }
}
