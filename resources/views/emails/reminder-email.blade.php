
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
    <title>Maintenance Reminder</title>
</head>
<body>
    <h2>🚗 Car Maintenance Reminder</h2>
    <p>Dear user,</p>
    <p>This is a reminder that your <strong>{{ $reminder->part_name }}</strong> needs maintenance.</p>
    <p>📅 Next Service Date: <strong>{{ $reminder->next_reminder_date }}</strong></p>
    <p>Please schedule an appointment to ensure your car runs smoothly.</p>
    <p>Best regards, <br> Your Car Maintenance Team</p>
</body>
</html>
