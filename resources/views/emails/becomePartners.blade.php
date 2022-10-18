@component('mail::message')
Hello {{$data}}

Thanks for choosing to become our partner , we will revert to you as soon as possible.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
