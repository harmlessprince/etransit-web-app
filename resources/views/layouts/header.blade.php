<section>
    <div id="topnav" style="height: 49px;background: #343f5f;">
        <div class="container">
            <div class="row" style="height: 49px;">
                <div class="col-sm-auto col-md-7 col-lg-7 col-xl-7 col-xxl-7" id="topparagrahp" style="height: 49px;">
                    <p id="faicon" style="text-align: center;color: var(--bs-white);margin-top: 9px;margin-left: 7px;width: 293.703px;margin-bottom: 22px;">
                        <i class="fa fa-facebook" style="padding-top: 5px;"></i>
                        <i class="fa fa-linkedin" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>&nbsp;
                        <i class="fa fa-google-plus justify-content-center align-items-center align-content-center" style="padding-top: 5px;"></i>&nbsp; &nbsp; |&nbsp;
                        hello@etransitafrica.com &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                </div>
                <div class="col-3 col-sm-auto" id="currency" style="text-align: center;">
                    <div class="dropdown" id="reducebutton-1" style="padding-top: 6px;padding-bottom: 6px;">
                        <button class="btn btn-light dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" id="reducebutton-2" type="button" style="color: rgb(255,255,255);background: rgb(52,63,95);border-style: none;border-color: rgba(255,255,255,0);font-size: 12px;">NGN&nbsp;&nbsp;</button>
                        <div class="dropdown-menu dropdown-menu-start" id="reducebutton-3"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </div>
                </div>
                <div class="col-sm-auto" id="countrydiv" style="padding-right: 0px;padding-left: 5px;">
                    <button class="btn btn-primary btn-lg text-start d-inline-flex" id="countrytext" type="button" style="margin: auto;width: 100%;color: var(--bs-white);margin-bottom: 2px;font-weight: 400;font-size: 14px;border-radius: 0px;background: rgba(247,247,247,0);border-style: none;border-color: rgba(255,255,255,0);padding-top: 12px;">
                        <img src="{{asset('new-assets/img/uk.svg')}}" style="max-width: 24px;margin-right: 12px;">English</button>
                </div>

                <div class="col">
                    <div class="row ">
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
                            <img class="rounded-circle img-fluid" width="30" height="30" src="{{asset('new-assets/img/user.png')}}" style="border: 2px solid var(--bs-white) ;">
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
        <div class="container"><a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('new-assets/img/logofull%201.png')}}"></a><button data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="text-align: right;">
                <ul class="navbar-nav navbar-nav-scroll text-end d-md-flex ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('/')}}" style="color: #06044e;">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#about_us_section" style="color: #06044e;">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('tour-packages')}}" style="color: #06044e;">Tour Packages</a></li>
                    <li class="nav-item">
                        <a href="{{url('boat-cruise')}}" class="nav-link" style="color: #06044e;">Boat Cruise&nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('car-hire')}}" class="nav-link"  style="color: #06044e;">Hire A vehicle</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Hotel Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('partners')}}" style="color: #06044e;">Become A Partner</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('parcel')}}" style="color: #06044e;">Send Parcel</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>
