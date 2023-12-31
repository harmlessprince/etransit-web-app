@component('mail::message')
    <p>Hi {{$data['name']}}, </p>
    <p>Your request has been completed!</p>
    <p> Here is a receipt of your booking ({{$data['service']}}).</p>
    <p>If you have any questions or concerns about your order, please contact us. </p>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
