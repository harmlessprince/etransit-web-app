@component('mail::message')
Hello {{$data['name']}} ,

<p>A new password has been regenerated for you .</p>
<p>Password : {{$data['password']}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
