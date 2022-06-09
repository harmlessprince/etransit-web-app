<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Etransit Partner</title>
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
    <link rel="stylesheet" href="{{asset('login-assets/csss/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css')}}">
    <link rel="stylesheet" href="{{asset('login-assets/csss/Ultimate-Testimonial-Slider-BS5.css')}}">

    <style>
        body {
            background-image: url("login-assets/img/Rectangle%203.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: metropolis-regular , Sans-Serif;
        }

        h1, h2,h3,h4,h5,h6{
            font-family: metropolis-semi-bold , Sans-Serif;
        }
        @media only screen and (max-device-width: 412px) {
            .auth_class{
                display:none !important;
            }
        }
    </style>
</head>

<body style="background: var(--bs-gray-300);border-style: none;border-bottom-width: 1px;border-bottom-color: rgb(168,168,169);">
<section>
    <div id="topnav" style="height: 49px;background: #343f5f;">
        <div class="container">
            <div class="row" style="height: 49px;">
                <div class="col-sm-auto col-md-8 col-lg-8 col-xl-8 col-xxl-8" id="topparagrahp" style="height: 49px;">
                    <p id="faicon" style="text-align: center;color: var(--bs-white);margin-top: 9px;margin-left: 7px;width: 293.703px;margin-bottom: 22px;">
                        <i class="fa fa-facebook" style="padding-top: 5px;"></i>
                        &nbsp;<i class="fa fa-linkedin" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>&nbsp;
                       <i class="fa fa-google-plus justify-content-center align-items-center align-content-center" style="padding-top: 5px;"></i>&nbsp;
                        &nbsp; |&nbsp; hello@etransitafrica.com&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                </div>
                <div class="col-auto col-sm-auto col-md-2 col-lg-2 col-xl-2 col-xxl-2" id="currency" style="text-align: center;">
                    <div class="dropdown" id="reducebutton-1" style="padding-top: 6px;padding-bottom: 6px;"><button class="btn btn-light dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" id="reducebutton-2" type="button" style="color: rgb(255,255,255);background: rgb(52,63,95);border-style: none;border-color: rgba(255,255,255,0);font-size: 12px;">NGN&nbsp;&nbsp;</button>
                        <div class="dropdown-menu dropdown-menu-start" id="reducebutton-3"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </div>
                </div>
                <div class="col-auto col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2" id="countrydiv" style="padding-right: 0px;padding-left: 5px;">
                    <button class="btn btn-primary btn-lg text-start d-inline-flex" id="countrytext" type="button" style="margin: auto;width: 100%;color: var(--bs-white);margin-bottom: 2px;font-weight: 400;font-size: 14px;border-radius: 0px;background: rgba(247,247,247,0);border-style: none;border-color: rgba(255,255,255,0);padding-top: 12px;">
                    <img src="{{asset('login-assets/img/uk.svg')}}" style="max-width: 24px;margin-right: 12px;">English</button>
                </div>
                <div class="col">
                    <div class="row">
                        @if(!Auth::check())
                            <div class="col-12 justify-content-lg-center align-items-lg-center auth_class"  style="text-align: center;padding-top: 9px;padding-bottom: 9px;">
                                <a href="{{url('/login')}}">
                                    <button class="btn btn-primary" type="button" style="height: 30px;padding-top: 2px;background: #e7710f;">&nbsp; Log in&nbsp;&nbsp;</button>
                                </a>
                                <a href="{{url('/register')}}">
                                    <button class="btn btn-primary" type="button" style="height: 30px;padding-top: 2px;margin-left: 20px;border-color: var(--bs-orange);background: rgba(13,110,253,0);">&nbsp;Sign Up&nbsp;</button>
                                </a>
                            </div>
                        @else
                            <div class="col-12 justify-content-lg-center align-items-lg-center" style="text-align: center;margin-top:5px;">
                                <img class="rounded-circle img-fluid" width="30" height="30" src="{{asset('new-assets/img/Testimonial%20male%20white.svg')}}" style="border: 2px solid var(--bs-white) ;">
                                <span style="color: var(--bs-white);margin-left: 10px;" class="btn dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong>{{auth()->user()->full_name}}</strong></span>
                                <ul style="background: #343f5f;" class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item"  href="{{url('profile/'. auth()->user()->id)}}">Profile</a></li>
                                    <li><a class="dropdown-item" onclick="showStatus()" href="#">Trip Status</a></li>
                                    <li><a class="dropdown-item" onclick="showPayment()" href="#">Payment History</a></li>
                                    <li><hr class="dropdown-divider"></li>

                                    <a href="{{ url('/logout') }}"  onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                        <button class="sign-up dropdown-item">Sign Out</button>
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section>
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container"><a class="navbar-brand" href="#"><img src="{{asset('login-assets/img/logofull%201.png')}}"></a>
            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" class="navbar-toggler">
                <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="text-align: right;">
                <ul class="navbar-nav navbar-nav-scroll text-end d-md-flex ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{url('/')}}" style="color: #06044e;">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/')}}" style="color: #06044e;">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('tour-packages')}}" style="color: #06044e;">Tour Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('boat-cruise')}}" style="color: #06044e;">Boat Cruise&nbsp;</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('car-hire')}}" style="color: #06044e;">Hire A  Vehicle</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Hotel Booking</a></li>
                    <li class="nav-item"><a class="nav-link"  href="{{url('partners')}}" style="color: #06044e;">Become A Partner</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('parcel')}}" style="color: #06044e;">Send Parcel</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<section style="padding-left: 0px;background: var(--bs-gray-100);">
    @if($errors->any())
        <div class="alert alert-danger">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-sm-3" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);"></div>
            <div class="col-sm-6" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);">
                <div class="row">
                    <div class="col">
                        <form action="{{url('store/become-partners')}}" method="POST" id="become_partners">
                            @csrf
                            <div class="row">
                                <div class="col" style="margin-top: 44px;">
                                    <h6 style="text-align: center;">Fill Form To Get Started</h6>
                                    <p style="font-size: 14px;text-align: center;color: rgb(170,170,170);">Hire our vehicles for your various trips and occasion</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">FULL NAME</label>
                                    <input class="form-control form-control-sm" type="text" name="full_name" value="{{old('full_name')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);padding-left: 14px;padding-right: 15px;"></div>
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">COMPANY</label>
                                    <input class="form-control form-control-sm" name="company_name" type="text" value="{{old('company_name')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">EMAIL ADDRESS</label>
                                    <input class="form-control form-control-sm" type="email" name="email" value="{{old('email')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                                <div class="col d-block">
                                    <div class="row d-md-flex">
                                        <div class="col-md-12"><label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 22px;">PHONE NUMBER</label>
                                            <input class="form-control form-control-sm" type="text" name="phone_number" value="{{old('phone_number')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">COMPANY ADDRESS</label>
                                    <input class="form-control form-control-sm" type="text" name="company_address" value="{{old('company_address')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label" for="notes" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">Notes</label>
                                    <input class="form-control form-control-sm" type="text" name="notes" id="notes"
                                              style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col" style="margin-top: 44px;">
                                    <h6 style="text-align: center;">How would you like to partiner with us?&nbsp;</h6>
{{--                                    <p style="font-size: 13px;color: rgb(170,170,170);text-align: center;">Lorem ipsum is dummy text for use only</p>--}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bus_partner" id="formCheck-1">
                                        <label class="form-check-label" for="formCheck-1">Bus Transport Partner</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="car_hire" id="formCheck-2">
                                        <label class="form-check-label" for="formCheck-2">Car Hire Partner</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
{{--            <div class="col-sm-6" id="secondtab" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;margin-top: 0px;"></div>--}}
        </div>
        <div class="row">
            <div class="col-12 d-md-flex justify-content-center align-items-center align-content-center align-self-center justify-content-md-center" style="text-align: center;margin-top: 14px;padding-bottom: 17px;">
                <button class="btn btn-primary" type="submit" form="become_partners" style="width: 235.422px;background: rgb(52,63,95);">SUBMIT</button>
            </div>
        </div>
    </div>
</section>
{{--<section style="background: #eeeeee;padding: 0px 0px 0px;padding-top: 20px;margin-top: 0px;">--}}
{{--    <div class="container">--}}
{{--        <div class="row" style="padding-bottom: 10px;">--}}
{{--            <div class="col-sm-6 d-md-flex flex-column align-content-center align-self-center">--}}
{{--                <h3 class="text-center" style="color: rgb(17,15,126);margin-top: 10px;"><strong>GET UPDATES AND MORE</strong></h3>--}}
{{--                <p class="text-center">THOUGHFUL THOUGHT TO YOU INBOX</p>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6 d-inline-flex d-md-flex align-items-md-center" id="divemail">--}}
{{--                <form><input type="email" id="emailinput" placeholder="YOUR EMAIL" inputmode="email" style="background: rgb(238,238,238);border-top-style: none;border-right-style: none;border-left-style: none;height: 41px;width: 250px;"></form>--}}
{{--                <button class="btn btn-primary" type="button" style="height: 31px;width: 113.5px;margin-left: -60px;padding-top: 3px;background: var(--bs-orange);border-top-style: none;">SUBSCRIBE</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<section style="background: #262466;">
    <footer id="footerid" style="background: url('{{ asset('/new-assets/img/footerimage.png')}}')  center / cover no-repeat, #20225f;padding: 40px;padding-bottom: 40px;border-style: none;border-top-width: 15px;max-height: auto;">
        <div class="container" style="padding-bottom: 20px;">
            <div class="row d-flex d-md-flex">
                <div class="col">
                    <h5 class="d-md-flex" style="color: var(--bs-orange);margin-bottom: 26px;width: 181px;text-align: left;"><strong>NEED HELP?</strong></h5>
                    <ul class="list-unstyled">
                        <li class="text-start d-md-flex align-items-md-center" style="color: var(--bs-gray-100);text-align: center;"><strong>CALL US</strong></li>
                        <li class="d-md-flex align-items-md-center" style="color: var(--bs-gray-100);font-size: 14px;">080 6430 4717</li>
                        <li class="text-start d-md-flex align-items-md-center" style="color: var(--bs-gray-100);text-align: center;margin-top: 37px;"><strong>EMAIL US</strong></li>
                        <li class="d-md-flex align-items-md-center" style="color: var(--bs-gray-100);font-size: 14px;">hello@etransitafrica.com</li>
                    </ul>
                </div>
                <div class="col flex-column">
                    <h5 style="color: var(--bs-orange);height: 26px;"><strong>COMPANY</strong></h5>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">ABOUT US</a></li>
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">COMMUNITY BLOG</a></li>
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="margin-bottom: 10px;color: var(--bs-gray-100);">REWARDS</a></li>
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">WORK WITH US</a></li>
                        <li><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">MEET THE TEAM</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5 style="color: var(--bs-orange);"><strong>SUPPORT</strong></h5>
                    <ul class="list-unstyled">
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">ACCOUNT</a></li>
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">LEGAL</a></li>
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="margin-bottom: 10px;color: var(--bs-gray-100);">CONTACT</a></li>
                        <li style="margin-bottom: 10px;"><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">AFFILIATE PROGRAM</a></li>
                        <li><a class="text-decoration-none" href="#" style="color: var(--bs-gray-100);">PRIVACY POLICY</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3 style="font-weight: bold;color: var(--bs-gray-100);">FOLLOW US ON</h3>
                    <ul class="list-inline">
                        <li class="list-inline-item"><i class="fa fa-twitter" style="font-size: 30px;color: var(--bs-gray-100);margin-right: 10px;"></i></li>
                        <li class="list-inline-item"><i class="fa fa-facebook-square" style="color: var(--bs-gray-100);font-size: 30px;margin-right: 10px;"></i></li>
                        <li class="list-inline-item"><i class="fa fa-youtube-play" style="color: var(--bs-gray-100);font-size: 30px;margin-right: 10px;"></i></li>
                        <li class="list-inline-item"><i class="fa fa-instagram" style="color: var(--bs-gray-100);font-size: 30px;"></i></li>
                    </ul>
                </div>
            </div>
            <div class="row" style="margin-top: 57px;">
                <div class="col">
                    <p style="color: var(--bs-gray-100);">Copyright 2021 by E-transit Africa</p>
                </div>
                <div class="col">
                    <p style="color: var(--bs-gray-100);font-weight: bold;text-align: right;">Powered By:&nbsp;<span style="color: var(--bs-orange);">Optisoft</span></p>
                </div>
            </div>
        </div>
    </footer>
</section>
<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvas-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"></h5>
        <div class="brands"><a href="{{url('/')}}">
                <img class="img-fluid" src="{{asset('login-assets/img/logofull%201.png')}}"></a>
        </div><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <ul class="list-unstyled" id="offcanvaslink">
                <li id="sidehover-1" style="height: 34px;"><a id="sidenav" class="text-decoration-none" href="{{url('/')}}" style="text-decoration: underline;font-weight: bold;">Home</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-2" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('/')}}" style="font-weight: bold;">About Us</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-3" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('tour-packages')}}" style="font-weight: bold;">Tour Packages</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-4" style="height: 34px;">
                    <a class="text-decoration-none"  href="{{url('boat-cruise')}}"  style="font-weight: bold;">Boat Cruise</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center text-decoration-none" id="sidehover-5" style="height: 34px;">
                    <a class="text-decoration-none"href="{{url('car-hire')}}" style="font-weight: bold;">Hire A Vehicle</a></li>
                <li id="sidehover-6" class="text-decoration-none" style="height: 34px;">
                    <a class="text-decoration-none" href="#" style="font-weight: bold;">Hotel Booking</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-7" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('partners')}}" style="font-weight: bold;">Become A Partner</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-8" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('parcel')}}" style="font-weight: bold;">Send Parcel</a></li>
            </ul>
        </nav>
        <p class="d-md-flex me-auto" id="faicon-1" style="text-align: left;color: #090b39;margin-top: 100px;margin-left: 0px;width: 293.703px;margin-bottom: 0px;background: var(--bs-body-bg);margin-right: auto;">&nbsp;<a href="#"><i class="fa fa-facebook d-md-flex align-items-md-end" style="padding-top: 5px;font-size: 25px;margin-right: 15px;"></i></a><a href="#"><i class="fa fa-linkedin d-md-flex align-items-md-end" style="color: rgb(13,110,253);padding-top: 5px;font-size: 25px;margin-right: 15px;"></i></a><a href="#"><i class="fa fa-google-plus d-md-flex justify-content-center align-items-center align-content-center" style="padding-top: 5px;font-size: 25px;"></i></a></p>
    </div>
</div>
<script src="{{asset('login-assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('login-assets/js/login-full-page-bs4.js')}}"></script>
<script src="{{asset('login-assets/js/Off-Canvas-Sidebar-Drawer-Navbar.js')}}"></script>
<script src="{{asset('login-assets/js/login-full-page-bs4-1.js')}}"></script>
<script src="{{asset('login-assets/js/Off-Canvas-Sidebar-Drawer-Navbar-1.js')}}"></script>
<script src="https://unpkg.chttps://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.jsom/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js" type="module"></script>
<script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js" type="module"></script>
<script src="{{asset('login-assets/js/Ultimate-Testimonial-Slider-BS5.js')}}"></script>
<script>
    $('document').ready(function()
    {
        $('textarea').each(function(){
                $(this).val($(this).val().trim());
            }
        );
    });
</script>
</body>

</html>
