@component('mail::message')
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