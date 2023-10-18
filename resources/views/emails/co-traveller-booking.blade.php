@component('mail::message')
    # Your Ride Details: Driver Information, Meeting Point, and Vehicle Information

    Dear [User's Name],

    We are excited to confirm your upcoming ride with **{{config('app.name')}}**! To ensure your journey is smooth and enjoyable, we have provided all the essential details you need below:

    **Driver Information:**

    - Driver's Name: {{$driver->full_name}}
    - Driver's Contact: {{$driver->phone_number}}

    **Meeting Point:**
    - Pickup: {{$schedule->pickup->location ?? "N/A"}}
    - Destination: {{$schedule->destination->location ?? "N/A"}}
    - Meeting Address: {{$schedule->pick_up_address ?? "N/A"}}
    - Meeting Address: {{$schedule->pick_up_address ?? "N/A"}}
    - Meeting Date: {{$schedule->departure_date->format("Y-m-d")}}
    - Meeting Time: {{$schedule->departure_time}}

    **Vehicle Information:**

    - Vehicle Type: {{$bus->bus_type}}
    - Vehicle Model: {{$bus->bus_model}}
    - Vehicle Color: {{$bus->bus_color}}
    - License Plate Number: {{$bus->bus_registration}}


    **Additional Notes:**

    - Please be ready a few minutes before the meeting time to ensure a timely departure.
    - If you have any specific requirements or special requests, please let us know in advance.

    If you have any questions, need to make changes, or wish to contact the driver, please don't hesitate to reach out to our customer support team at {{config('app.etransit_admin_email')}} or {{config('app.whatsapp_number')}}.

    Thank you for choosing **{{config('app.name')}}** for your transportation needs. We look forward to providing you with a safe and comfortable journey.

    Safe travels!

    Warm regards,
    Thanks,
    {{ config('app.name') }}
@endcomponent
