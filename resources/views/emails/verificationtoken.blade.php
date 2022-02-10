@component('mail::message')
hi , <br>
<p>Below is your email verification token</p>
<p>Token : {{$data['verify_token']}}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
