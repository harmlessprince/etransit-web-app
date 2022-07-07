@component('mail::message')
    <p>Hi {{$data['name']}}, </p>
    <p>Below is your login credentials to your driver's platform on E-transit! We're excited to have you on board</p>
    <p>
        Email : {{$data['email']}}.<br/>
        Password : {{$data['password']}} <br/>
        Link : {{$data['url_link']}} <br/>
    </p>
    <p>Welcome on board </p>
    Thanks,<br/>
    {{ config('app.name') }}
@endcomponent
