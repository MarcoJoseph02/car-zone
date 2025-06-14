
{{-- @component('mail::message') --}}

{{-- @component('mail::message')

# Reminder for Your Car

It's time to check your **{{ $reminder->part_name }}**.

@if($reminder->reminder_type == 'time')
- Due Date: {{ $reminder->next_reminder_date }}
@elseif($reminder->reminder_type == 'usage')
- Due at: {{ $reminder->next_reminder_km }} km
@endif

Thanks,  
{{ config('app.name') }}
@endcomponent
{{
//dd($reminder);
}
}

} --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance Reminder</title>
</head>
<body>
    <h2>🚗 Car Maintenance Reminder</h2>
    <p>Dear {{$car->user->name }},</p>
    {{-- <p>This is a reminder that your <strong>{{ $reminder->part_name }}</strong> needs maintenance.</p>
    <p>📅 Next Service Date: <strong>{{ $reminder->next_reminder_date }}</strong></p>
    <p>Please schedule an appointment to ensure your car runs smoothly.</p>
    <p>Best regards, <br> Your Car Maintenance Team</p> --}}
    <p>This is a reminder for the upcoming maintenance of your car's part: {{ $part_name }}.</p>
    <p>The next maintenance is due on: {{ $next_reminder_date }}.</p>
    <p>Please make sure to schedule the maintenance at your earliest convenience.</p>
    <p>Thank you for choosing us!</p>
</body>
</html>
