<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Hello {{ $booking->user->name }},</h1>
    <p>Your booking deposit for the car <strong>{{ $booking->car->model }}</strong> has been paid successfully.</p>
    <p>Amount Paid: <strong>${{ $booking->deposit_amount }}</strong></p>
    <p>Status: <strong>{{ $booking->status }}</strong></p>
    <p>Thank you for booking with us!</p>
</body>
</html>
