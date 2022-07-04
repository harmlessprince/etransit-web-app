@component('mail::message')
Hi {{$data['name']}}

<p>Below is your login credentials</p>
<p>Email : {{$data['email']}}</p>
<p>Password : {{$data['password']}}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
