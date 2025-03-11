<!DOCTYPE html>
<html>
<head>
    <title>Email Notification</title>
</head>
<body>
    <h1>Hello,</h1>
    {{-- <p>{{ $messageContent }}</p> --}}
    <p>{{ $token }}</p>
    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>


{{-- @component('vendor.mail.html.message')
# Hello,

{{ $messageContent }}

Thanks,  
{{ config('app.name') }}
@endcomponent
 --}}
