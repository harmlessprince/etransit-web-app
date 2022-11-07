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
                        <a href="https://web.facebook.com/etransitafrica" target="_blank">
                            <i class="fa fa-facebook" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>
                        </a>

                        <a href="https://twitter.com/etransitafrica" target="_blank">
                            <i class="fa fa-twitter" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>&nbsp;
                        </a>
                        <a href="https://www.instagram.com/etransitafrica/" target="_blank">
                            <i class="fa fa-instagram justify-content-center align-items-center align-content-center" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>
                        </a>
                        &nbsp; &nbsp; |&nbsp;
                        hello@etransitafrica.com &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                </div>
                <button class="btn btn-primary btn-lg text-start d-inline-flex" id="countrytext" type="button" style="margin: auto;width: 100%;color: var(--bs-white);margin-bottom: 2px;font-weight: 400;font-size: 14px;border-radius: 0px;background: rgba(247,247,247,0);border-style: none;border-color: rgba(255,255,255,0);padding-top: 12px;">
                    <img src="{{asset('new-assets/img/uk.svg')}}" style="max-width: 24px;margin-right: 12px;">English</button>
            </div>
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
                <ul class="navbar-nav navbar-nav-scroll text-end d-md-flex ms-auto">
{{--                    <li class="nav-item"><a class="nav-link active" href="{{url('/')}}" style="color: #06044e;">Home</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{url('tour-packages')}}" style="color: #06044e;">Tour Packages</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{url('boat-cruise')}}" style="color: #06044e;">Boat Cruise</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{url('car-hire')}}" style="color: #06044e;">Hire A Vehicle</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{url('partners')}}" style="color: #06044e;">Become A Partner<br></a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{url('parcel')}}" style="color: #06044e;">Parcel</a></li>--}}
{{--                    <li class="nav-item"></li>--}}
                </ul>
            </div>
        </div>
    </nav>
</section>
<section style="padding-right: 12px;padding-top: 0px;padding-left: 12px;">
    <div class="container">
        <div class="row" style="margin-top: 5%;margin-bottom: 0%;">
            <div class="col d-flex d-sm-flex d-md-flex justify-content-center justify-content-sm-center justify-content-md-center" style="background: rgba(255,255,255,0);">
                <div style="background: var(--bs-white);padding: 25px;padding-top: 30px;">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <div>
                                    <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                </div>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
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
                <li id="sidehover-1" style="height: 34px;"><a id="sidenav" class="text-decoration-none" href="{{url('/')}}" style="text-decoration: underline;font-weight: bold;">Home</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-2" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('tour-packages')}}" style="font-weight: bold;">Tour Packages</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-3" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('boat-cruise')}}" style="font-weight: bold;">Boat Cruise</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center text-decoration-none" id="sidehover-5" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('car-hire')}}" style="font-weight: bold;">Hire A Vehicle</a></li>
                <li id="sidehover-6" class="text-decoration-none" style="height: 34px;">
                    <a class="text-decoration-none" href="#" style="font-weight: bold;">Become A Partner</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-7" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('parcel')}}" style="font-weight: bold;">Parcel</a>
                </li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-7" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('contact')}}" style="font-weight: bold;">Contact</a>
                </li>
            </ul>
            <div class="col-12 d-lg-flex justify-content-lg-left align-items-lg-left" style="text-align:left;padding-top: 9px;padding-bottom: 9px;"><button class="btn btn-primary" type="button" style="height: 30px;padding-top: 2px;margin-left: 20px;border-color: var(--bs-orange);background: rgba(13,110,253,0);color: rgb(231,113,15);">&nbsp;Sign Up&nbsp;</button></div>
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
