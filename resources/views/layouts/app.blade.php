<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>--}}
{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">--}}
{{--    @stack('css')--}}
{{--    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('new-assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arsenal&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/material-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/typicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Brands.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/etransit-top-nav.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/etransit-vehicle-slide.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Etransitnews.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Form-Input.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="{{asset('new-assets/css/Login-Form-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/MAV_LanguageSelectButton.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Modern-Contact-Form.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Responsive-Product-Slider.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Search-Input-Responsive-with-Icon.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Timeline-Steps.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Ultimate-Testimonial-Slider-BS5.css')}}">
{{--    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>--}}


{{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">--}}
{{--    @stack('css')--}}
{{--    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    @toastr_css

</head>
<body onload="busnav()">
    <div>
        <div >
        @include('layouts.header')
            @yield('content')
        @include('layouts.footer')
        </div>
    </div>
</body>
</html>
