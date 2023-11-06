{{--@component('mail::message')--}}
{{--    # Your Ride Details: Driver Information, Meeting Point, and Vehicle Information--}}

{{--    Dear [User's Name],--}}

{{--    We are excited to confirm your upcoming ride with **{{config('app.name')}}**! To ensure your journey is smooth and enjoyable, we have provided all the essential details you need below:--}}

{{--        **Driver Information:**--}}
{{--    --}}
{{--        - Driver's Name: {{$driver->full_name}}--}}
{{--        - Driver's Contact: {{$driver->phone_number}}--}}

{{--    **Meeting Point:**--}}


{{--    **Vehicle Information:**--}}

{{--    - Vehicle Type: {{$bus->bus_type}}--}}
{{--    - Vehicle Model: {{$bus->bus_model}}--}}
{{--    - Vehicle Color: {{$bus->bus_color}}--}}
{{--    - License Plate Number: {{$bus->bus_registration}}--}}


{{--    **Additional Notes:**--}}

{{--    - Please be ready a few minutes before the meeting time to ensure a timely departure.--}}
{{--    - If you have any specific requirements or special requests, please let us know in advance.--}}

{{--    If you have any questions, need to make changes, or wish to contact the driver, please don't hesitate to reach out to our customer support team at {{config('app.etransit_admin_email')}} or {{config('app.whatsapp_number')}}.--}}

{{--    Thank you for choosing **{{config('app.name')}}** for your transportation needs. We look forward to providing you with a safe and comfortable journey.--}}

{{--    Safe travels!--}}

{{--    Warm regards,--}}
{{--    Thanks,--}}
{{--    {{ config('app.name') }}--}}
{{--@endcomponent--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Details Email</title>
    <style>
        /* Basic styles for the email */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .email_header {
            background-color: #e16803;
            color: whitesmoke;
            padding: 20px;
            text-align: center;
        }

        .email_header h1 {
            margin: 0;
            font-size: 24px;
            color: whitesmoke;
        }

        .email-content {
            padding: 20px;
        }

        .email-footer {
            background-color: #e16803;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        /* Styles for the specific details */
        .driver-info {
            text-align: center;
        }

        .driver-image {
            max-width: 200px;
            border: 2px solid #e16803;
            border-radius: 50%;
        }

        .meeting-point {
            margin-top: 20px;
        }

        .vehicle-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email_header">
        <h1>{{ config('app.name') }}</h1>
    </div>
    <div class="email-content">
        <div class="driver-info">
            <img src="{{$driver->picture}}" alt="Driver Image" class="driver-image">
            <h2>Driver Information</h2>
            <p>Driver's Name: {{$driver->full_name}}</p>
            <p>Driver's Contact: {{$driver->phone_number}}</p>
        </div>
        <div class="meeting-point">
            <h2>Meeting Point</h2>
            <p> Pickup: {{$schedule->pickup->location ?? "N/A"}}</p>
            <p> Destination: {{$schedule->destination->location ?? "N/A"}}</p>
            <p> Meeting Address: {{$schedule->pick_up_address ?? "N/A"}}</p>
            <p> Meeting Address: {{$schedule->pick_up_address ?? "N/A"}}</p>
            <p> Meeting Date: {{$schedule->departure_date->format("Y-m-d") ?? "N/A"}}</p>
            <p> Meeting Time: {{$schedule->departure_time}}</p>
        </div>
        <div class="vehicle-info">
            <h2>Vehicle Information</h2>
            <p>Vehicle Type: {{$bus->bus_type}}</p>
            <p>Vehicle Model: {{$bus->bus_model}}</p>
            <p>Vehicle Color: {{$bus->bus_color ?? "N/A"}}</p>
            <p>License Plate Number: {{$bus->bus_registration}}</p>
        </div>
    </div>
    <div class="email-footer">
        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
    </div>
</div>
</body>
</html>
