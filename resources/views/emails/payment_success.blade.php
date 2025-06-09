<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Thank you for your payment!</h1>

    <p>Hi {{ $booking->user->fname . ' ' . $booking->user->lname }},</p>

    <p>Your payment of {{ $booking->deposit_amount }} has been successfully processed.</p>

    <p>For Car: {{ $booking->car->model }}</p>

    <p>We appreciate your business.</p>

    <p>Best regards,<br>Car Zone</p>
</body>
</html>
