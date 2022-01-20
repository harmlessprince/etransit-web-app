@component('mail::message')
    Hi ,
    Your request has been completed!

    Here is a receipt of your booking(mentioning the particular one). If you have any questions or concerns about your order, please contact us.

    Then the receipt will contain a replica of the one on the app

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
