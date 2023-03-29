@component('mail::message')
Hello {{$data['name']}} ,

<p>Your password change request has been approved</p>
<p>You can now log in with your new password</p>
<!-- <a href="{{config('app.url')/e-ticket}}">Click here to log in</a> -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
