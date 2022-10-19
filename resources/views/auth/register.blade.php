<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Etransit Registration</title>
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
    <link href="{{asset('css/font.css')}}" rel="stylesheet"/>
    <style>

        body {
            font-family: metropolis-regular , Sans-Serif;
        }
        h1, h2,h3,h4,h5,h6{
            font-family: metropolis-semi-bold , Sans-Serif;
        }
        .google_btn{
            text-decoration: none !important;
        }
        @media only screen and (max-width: 600px) {
            .signup-image {
                display: none;
            }
        }
    </style>
</head>

<body>
<section>
    <div id="topnav" style="height: 49px;background: #343f5f;">
        <div class="container">
            <div class="row" style="height: 49px;">
                <div class="col-sm-auto col-md-7 col-lg-7 col-xl-7 col-xxl-7" id="topparagrahp" style="height: 49px;">
                    <p id="faicon" style="text-align: center;color: var(--bs-white);margin-top: 9px;margin-left: 7px;width: 293.703px;margin-bottom: 22px;"><i class="fa fa-facebook" style="padding-top: 5px;"></i>&nbsp; &nbsp;&nbsp;<i class="fa fa-linkedin" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>&nbsp; &nbsp; &nbsp;<i class="fa fa-google-plus justify-content-center align-items-center align-content-center" style="padding-top: 5px;"></i>&nbsp; &nbsp; |&nbsp; hello@etransitafrica.com&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                </div>
                <div class="col-sm-2" id="countrydiv" style="padding-right: 0px;padding-left: 5px;"><button class="btn btn-primary btn-lg text-start d-inline-flex" id="countrytext" type="button" style="margin: auto;width: 100%;color: var(--bs-white);margin-bottom: 2px;font-weight: 400;font-size: 14px;border-radius: 0px;background: rgba(247,247,247,0);border-style: none;border-color: rgba(255,255,255,0);padding-top: 12px;"><img src="{{asset('login-assets/img/uk.svg')}}" style="max-width: 24px;margin-right: 12px;">English</button></div>
                <div class="col">
                    <div class="row">
                        <div class="col-12 d-lg-flex justify-content-lg-center align-items-lg-center" id="websignupdiv" style="text-align: center;padding-top: 9px;padding-bottom: 9px;">
                            <a href="{{route('login')}}" class="btn btn-primary"
                               style="height: 30px;padding-top: 2px;background: #e7710f;">&nbsp; Log in&nbsp;&nbsp;</a>
                        </div>
                        <div class="col-12 justify-content-lg-center align-items-lg-center" style="text-align: center; display: none;">
                            <img class="rounded-circle img-fluid" width="40" height="40" src="{{asset('login-assets/img/Testimonial%20male%20white.svg')}}"
                                 style="border: 2px solid var(--bs-white) ;"><span style="color: var(--bs-white);margin-left: 20px;"><strong>Nick Doe</strong></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background: var(--bs-white);">
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container"><a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('login-assets/img/logofull%201.png')}}"></a><button data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="text-align: right;">
                <ul class="navbar-nav navbar-nav-scroll text-end d-md-flex ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{url('/')}}" style="color: #06044e;">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('tour-packages')}}" style="color: #06044e;">Tour Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('boat-cruise')}}" style="color: #06044e;">Boat Cruise</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('car-hire')}}" style="color: #06044e;">Hire A Vehicle</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Become A Partner<br></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('parcel')}}" style="color: #06044e;">Parcel</a></li>
                    <li class="nav-item"></li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<section style="padding-right: 12px;padding-top: 0px;padding-left: 12px;">
    <div class="container">
        <div class="row" style="margin-top: 3%;margin-bottom: 0%;">
            <div class="col justify-content-center signup-image">
                <img src="{{ asset('login-assets/img/signup1.png')}}" class="img-fluid">
            </div>

            <div class="col d-flex d-sm-flex d-md-flex justify-content-center justify-content-sm-center justify-content-md-center" style="background: rgba(255,255,255,0);">
                <div style="width: 350px;background: var(--bs-white);padding: 25px;padding-top: 30px;">
                    <h5 style="text-align: center;">SIGN UP</h5>
                    <p style="text-align: center;color: var(--bs-gray-500);"> Already have an account?&nbsp;&nbsp;<a href="{{route('login')}}" style="color: rgb(231,113,15);">Log in</a>&nbsp;</p>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                       <div class="form-group">
                           <label class="form-label" style="margin-top: 0px;margin-bottom: 0px;">FULL NAME</label>
                           <input class="form-control form-control-sm @error('full_name')is-invalid @enderror" value="{{old('full_name')}}" type="text" name="full_name"
                                  style="border-top-style: none;border-right-style: none;border-left-style: none;">
                           @error('full_name')
                           <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                           @enderror
                       </div>
                       <div class="form-group">
                           <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">ADDRESS</label>
                           <input class="form-control form-control-sm @error('address')is-invalid @enderror" name="address" value="{{old('address')}}" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;">
                           @error('address')
                           <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                           @enderror
                       </div>
                        <div class="form-group">
                            <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">EMAIL</label>
                            <input class="form-control form-control-sm @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      <div class="form-group">
                          <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">PHONE NUMBER</label>
                          <input class="form-control form-control-sm @error('phone_number') is-invalid @enderror" value="{{old('phone_number')}}" name="phone_number" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;">
                          @error('phone_number')
                          <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">NATIONAL IDENTIFICATION NUMBER</label>
                        <input class="form-control form-control-sm @error('nin') is-invalid @enderror" name="nin" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;">
                        @error('nin')
                        <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                        @enderror
                    </div>
                        <div class="form-group">
                            <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">USERNAME</label>
                            <input class="form-control form-control-sm @error('username') is-invalid @enderror" value="{{old('username')}}" name="username" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                       <div class="form-group">
                           <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">PASSWORD</label>
                           <input class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" type="password" style="border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;border-top-style: none;border-right-style: none;border-left-style: none;">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                           @enderror
                       </div>
                          <div class="form-group">
                              <label class="form-label" style="margin-top: 5px;margin-bottom: 0px;">CONFIRM PASSWORD</label>
                              <input class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" style="border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;border-top-style: none;border-right-style: none;border-left-style: none;">
                              @error('password_confirmation')
                              <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                              @enderror
                          </div>
                        <p class="d-flex d-sm-flex d-md-flex d-lg-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center" style="text-align: center;margin-bottom: 5px;">
                            <button class="btn btn-primary d-block d-lg-flex" type="submit" style="height: 30px;padding-top: 0px;padding-right: 80px;padding-left: 80px;margin-top: 21px;background: #dc6513;">SIGN UP</button></p>
{{--                        <span class="d-block d-lg-flex justify-content-lg-center" style="text-align: center;font-size: 13px;">Or</span>--}}
                        <p class="d-flex d-sm-flex d-md-flex d-lg-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center" style="text-align: center;">
                            <a href="{{url('login/google')}}" class="google_btn">
                            <button class="btn btn-primary d-block d-lg-flex" type="button" style="margin-top: 5px;height: 30px;padding-top: 1px;padding-right: 25px;padding-left: 25px;background: #eb5757;">
                                SIGN UP WITH GOOGLE
                            </button>
                            </a>
                        </p>
                        <p style="text-align: center;color: var(--bs-gray-500);">Forgot your account?&nbsp;&nbsp; <br>
                            <a href="{{route('password.request')}}" style="color: rgb(231,113,15);">Reset Password</a>&nbsp;
                        </p>

{{--                        <p class="d-flex d-sm-flex d-md-flex d-lg-flex justify-content-center justify-content-sm-center justify-content-md-center justify-content-lg-center" style="text-align: center;">--}}
{{--                            <button class="btn btn-primary d-block d-lg-flex" type="button" style="height: 30px;padding-top: 1px;padding-right: 18px;padding-left: 18px;">SIGN UP WITH FACEBOOK</button></p>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvas-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"></h5>
        <div class="brands"><a href="#"> <img class="img-fluid" src="{{asset('login-assets/img/logofull%201.png')}}"></a></div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <ul class="list-unstyled" id="offcanvaslink">
                <li id="sidehover-1" style="height: 34px;"><a id="sidenav" class="text-decoration-none" href="{{url('/')}}" style="text-decoration: underline;font-weight: bold;">Home</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-2" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('tour-packages')}}" style="font-weight: bold;">Tour Packages</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-3" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('boat-cruise')}}"  style="font-weight: bold;">Boat Cruise</a></li>
{{--                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-4" style="height: 34px;">--}}
{{--                    <a class="text-decoration-none" href="#" style="font-weight: bold;">Bus</a>--}}
{{--                </li>--}}
                <li class="d-md-flex justify-content-md-start align-items-md-center text-decoration-none" id="sidehover-5" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('car-hire')}}" style="font-weight: bold;">Hire A Vehicle</a></li>
                <li id="sidehover-6" class="text-decoration-none" style="height: 34px;">
                    <a class="text-decoration-none" href="#" style="font-weight: bold;">Become A Partner</a></li>
                <li class="d-md-flex justify-content-md-start align-items-md-center" id="sidehover-7" style="height: 34px;">
                    <a class="text-decoration-none" href="{{url('parcel')}}" style="font-weight: bold;">Parcel</a></li>
            </ul>
            <div class="col-12 d-lg-flex justify-content-lg-center align-items-lg-center" style="text-align: center;padding-top: 9px;padding-bottom: 9px;">
                <a href="{{route('login')}}" class="btn btn-primary" type="button" style="height: 30px;padding-top: 2px;margin-left: 20px;border-color: var(--bs-orange);background: var(--bs-orange);color: var(--bs-white);">Log in</a></div>
        </nav>
        <p class="d-md-flex me-auto" id="faicon-1" style="text-align: left;color: #090b39;margin-top: 100px;margin-left: 0px;width: 293.703px;margin-bottom: 0px;background: var(--bs-body-bg);margin-right: auto;">&nbsp;
            <a href="#">
                <i class="fa fa-facebook d-md-flex align-items-md-end" style="padding-top: 5px;font-size: 25px;margin-right: 15px;"></i>
            </a>
            <a href="#">
                <i class="fa fa-linkedin d-md-flex align-items-md-end" style="color: rgb(13,110,253);padding-top: 5px;font-size: 25px;margin-right: 15px;"></i>
            </a>
            <a href="#">
                <i class="fa fa-google-plus d-md-flex justify-content-center align-items-center align-content-center" style="padding-top: 5px;font-size: 25px;"></i>
            </a>
        </p>
    </div>
</div>
<script src="{{asset('login-assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('login-assets/js/login-full-page-bs4.js')}}"></script>
<script src="{{asset('login-assets/js/Off-Canvas-Sidebar-Drawer-Navbar.j')}}s"></script>
<script src="{{asset('login-assets/js/login-full-page-bs4-1.js')}}"></script>
<script src="{{asset('login-assets/js/Off-Canvas-Sidebar-Drawer-Navbar-1.js')}}"></script>
<script src="https://unpkg.chttps://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.jsom/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js" type="module"></script>
<script src="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.js" type="module"></script>
<script src="{{asset('login-assets/js/Ultimate-Testimonial-Slider-BS5.js')}}"></script>
</body>

</html>
