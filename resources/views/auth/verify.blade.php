{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('resent'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('Before proceeding, please check your email for a verification link.') }}--}}
{{--                    {{ __('If you did not receive the email') }},--}}
{{--                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Etransit Login</title>
    <link rel="stylesheet" href="{{asset('login-assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arsenal&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;display=swap">
    <link rel="stylesheet" href="{{asset('login-assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Brands.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/etransit-top-nav.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/etransit-vehicle-slide.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Etransitnews.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Form-Input.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Login-Form-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/login-full-page-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/MAV_LanguageSelectButton.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Modern-Contact-Form.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Off-Canvas-Sidebar-Drawer-Navbar.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Responsive-Product-Slider.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Search-Input-Responsive-with-Icon.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/styles.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Timeline-Steps.css')}}">
    <link rel="stylesheet" href="{{asset('loginassets/csss/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Ultimate-Testimonial-Slider-BS5.css')}}">
    <style>
        body {
            background-image: url("{{asset('login-assets/img/signin.jpg')}}");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: metropolis-regular , Sans-Serif;
        }

        h1, h2,h3,h4,h5,h6{
            font-family: metropolis-semi-bold , Sans-Serif;
        }
    </style>
</head>

<body>
<section>
    <div id="topnav" style="height: 49px;background: #343f5f;">
        <div class="container">
            <div class="row" style="height: 49px;">
                <div class="col-sm-auto col-md-7 col-lg-7 col-xl-7 col-xxl-7" id="topparagrahp" style="height: 49px;">
                    <p id="faicon" style="text-align: center;color: var(--bs-white);margin-top: 9px;margin-left: 7px;width: 293.703px;margin-bottom: 22px;">
                        <i class="fa fa-facebook" style="padding-top: 5px;"></i>&nbsp; &nbsp;&nbsp;
                        <i class="fa fa-linkedin" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>&nbsp; &nbsp; &nbsp;
                        <i class="fa fa-google-plus justify-content-center align-items-center align-content-center" style="padding-top: 5px;"></i>|&nbsp; hello@etransitafrica.com</p>
                </div>
                <div class="col-auto col-sm-auto" id="currency" style="text-align: center;">
                    <div class="dropdown" id="reducebutton-1" style="padding-top: 6px;padding-bottom: 6px;">
                        <button class="btn btn-light dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" id="reducebutton-2" type="button" style="color: rgb(255,255,255);background: rgb(52,63,95);border-style: none;border-color: rgba(255,255,255,0);font-size: 12px;">NGN&nbsp;&nbsp;</button>
                        <div class="dropdown-menu dropdown-menu-start" id="reducebutton-3"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </div>
                </div>
                <div class="col-sm-2" id="countrydiv" style="padding-right: 0px;padding-left: 5px;">
                    <button class="btn btn-primary btn-lg text-start d-inline-flex" id="countrytext" type="button" style="margin: auto;width: 100%;color: var(--bs-white);margin-bottom: 2px;font-weight: 400;font-size: 14px;border-radius: 0px;background: rgba(247,247,247,0);border-style: none;border-color: rgba(255,255,255,0);padding-top: 12px;">
                        <img src="{{asset('login-assets/img/uk.svg')}}" style="max-width: 24px;margin-right: 12px;">English</button></div>
                <div class="col">
                    <div class="row">
                        <div class="col-12 d-lg-flex justify-content-lg-center align-items-lg-center" id="websignupdiv" style="text-align: center;padding-top: 9px;padding-bottom: 9px;">
                            <a href="{{route('register')}}" class="btn btn-primary"  style="height: 30px;padding-top: 2px;margin-left: 20px;border-color: var(--bs-orange);background: rgba(13,110,253,0);">&nbsp;Sign Up&nbsp;</a></div>
                        <div class="col-12 justify-content-lg-center align-items-lg-center" style="text-align: center; display: none;">
                            <img class="rounded-circle img-fluid" width="40" height="40" src="{{asset('login-assets/img/Testimonial%20male%20white.svg')}}" style="border: 2px solid var(--bs-white) ;">
                            <span style="color: var(--bs-white);margin-left: 20px;"><strong>Nick Doe</strong></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--bs-white);">
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container"><a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('login-assets/img/logofull%201.png')}}"></a>
            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" class="navbar-toggler">
                <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1" style="text-align: right;">
            </div>
        </div>
    </nav>
</section>
<section style="padding-right: 12px;padding-top: 0px;padding-left: 12px;">
    <div class="container">
        <div class="row" style="margin-top: 5%;margin-bottom: 0%;">
            <div class="col d-flex d-sm-flex d-md-flex justify-content-center justify-content-sm-center justify-content-md-center" style="background: rgba(255,255,255,0);">
                <div style=";background: var(--bs-white);padding: 25px;padding-top: 30px;">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvas-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"></h5>
        <div class="brands">
            <a href="{{url('/')}}"> <img class="img-fluid" src="{{asset('login-assets/img/logofull%201.png')}}"></a>
        </div><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <ul class="list-unstyled" id="offcanvaslink">

            </ul>
            <div class="col-12 d-lg-flex justify-content-lg-center align-items-lg-center" style="text-align: center;padding-top: 9px;padding-bottom: 9px;"><button class="btn btn-primary" type="button" style="height: 30px;padding-top: 2px;margin-left: 20px;border-color: var(--bs-orange);background: rgba(13,110,253,0);color: rgb(231,113,15);">&nbsp;Sign Up&nbsp;</button></div>
        </nav>
        <p class="d-md-flex me-auto" id="faicon-1" style="text-align: left;color: #090b39;margin-top: 100px;margin-left: 0px;width: 293.703px;margin-bottom: 0px;background: var(--bs-body-bg);margin-right: auto;">&nbsp;<a href="#"><i class="fa fa-facebook d-md-flex align-items-md-end" style="padding-top: 5px;font-size: 25px;margin-right: 15px;"></i></a><a href="#"><i class="fa fa-linkedin d-md-flex align-items-md-end" style="color: rgb(13,110,253);padding-top: 5px;font-size: 25px;margin-right: 15px;"></i></a><a href="#"><i class="fa fa-google-plus d-md-flex justify-content-center align-items-center align-content-center" style="padding-top: 5px;font-size: 25px;"></i></a></p>
    </div>
</div>
<script src="{{asset('login-assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('login-assets/js/login-full-page-bs4.js')}}"></script>
<script src="{{asset('login-assets/js/Off-Canvas-Sidebar-Drawer-Navbar.js')}}"></script>
<script src="{{asset('login-assets/js/login-full-page-bs4-1.js')}}"></script>
<script src="login-assets/js/Off-Canvas-Sidebar-Drawer-Navbar-1.js"></script>
<script src="https://unpkg.chttps://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.jsom/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js" type="module"></script>
<script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js" type="module"></script>
<script src="{{asset('login-assets/js/Ultimate-Testimonial-Slider-BS5.js')}}"></script>
</body>

</html>
