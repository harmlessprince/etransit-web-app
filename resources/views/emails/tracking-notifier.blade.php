@component('mail::message')
Hello  {{$data['trustee_name']}} , <br>

Below is your OTP token to track this user ( {{$data['tracked_user']}} ) <br>
OTP: {{$data['otp']}}

@component('mail::button', ['url' => $data['url']])
Track User
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
