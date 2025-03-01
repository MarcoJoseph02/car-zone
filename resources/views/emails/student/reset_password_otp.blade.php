{{-- @extends('mail_layout.student.master')

@section('content')
    {{ trans('emails.Forget Password Title') }}<br>
    {{-- {{ trans('app.forget password otp' , ['otp'=> $code]) }}<br> --}}
    {{-- {{ trans('emails.Thanks') }},<br> --}}
    {{-- {{ config('app.name') }} --}}
{{-- @endsection --}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{ trans('emails.Forget Password Title') }}<br>
    {{-- {{ trans('app.forget password otp' , ['otp'=>new ResetPasswordMail($token)]) }}<br> --}}
    {{ trans('emails.Thanks') }},<br>
    {{ config('app.name') }}<br>
</body>
    