
{{--    <div>--}}
{{--        <header class="navigation-header">--}}
{{--            <div class="nav-content">--}}
{{--                <div class="socials-block">--}}
{{--                    <div class="social-icons">--}}
{{--                        <!--                        <img :src="'/images/socials/facebook.png'"  alt="facebook-img"/>-->--}}
{{--                        <!--                        <img :src="'/images/socials/linkedin.png'"  alt="linkedin-img"/>-->--}}
{{--                        <!--                        <img :src="'/images/socials/google.png'"  alt="google-plus-img"/>-->--}}
{{--                    </div>--}}
{{--                    <!--                    <div class="breaker">-->--}}
{{--                    <!--                    </div>-->--}}
{{--                    <div class="email-container">--}}
{{--                        <span>example@email.com</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="currency-block">--}}
{{--                    <span>NGN</span>--}}
{{--                    <span>English</span>--}}
{{--                    @if(!Auth::check())--}}
{{--                    <a href="{{url('/login')}}">--}}
{{--                        <button  class="login">Login</button>--}}
{{--                    </a>--}}
{{--                    <a href="{{url('/register')}}">--}}
{{--                        <button class="sign-up">Sign Up</button>--}}
{{--                    </a>--}}
{{--                    @else--}}
{{--                        <a href="{{ url('/logout') }}"  onclick="event.preventDefault();--}}
{{--                          document.getElementById('logout-form').submit();">--}}
{{--                        <button class="sign-up">Sign Out</button>--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">--}}
{{--                        @csrf--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </header>--}}
{{--        <nav class="bottom-nav">--}}
{{--            <div class="logo">--}}
{{--                <img  src={{asset('/images/logo/et-logo.png')}} alt="Etransit-logo"/>--}}
{{--            </div>--}}
{{--            <div class="nav-menu">--}}
{{--                <ul>--}}
{{--                    <li><a  href="/" class="routerLink {{ (request()->is('/')) ? 'active-text' : '' }}" active-link='active'> Home </a><span class="{{ (request()->is('/')) ? 'active-nav' : '' }}"></span></li>--}}
{{--                    <li><a href="#about_us_section" class="routerLink" active-link='active' > About Us </a></li>--}}
{{--                    <li><a href="{{url('tour-packages')}}" class="routerLink {{ (request()->is('tour-packages')) ? 'active-text' : '' }}" active-link='active'> Tour Packages </a><span class="{{ (request()->is('tour-packages')) ? 'active-nav' : '' }}"></span></li>--}}
{{--                    <li><a href="{{url('boat-cruise')}}" class="routerLink {{ (request()->is('boat-cruise')) ? 'active-text' : '' }}" active-link='active'> Boat Cruise </a><span class="{{ (request()->is('boat-cruise')) ? 'active-nav' : '' }}"></span></li>--}}
{{--                    <li><a href="{{url('car-hire')}}" class="routerLink {{ (request()->is('car-hire')) ? 'active-text' : '' }}" active-link='active'> Hire A Vehicle </a> <span class="{{ (request()->is('car-hire')) ? 'active-nav' : '' }}"></span></li>--}}
{{--                    <li><a href="/" class="routerLink" active-link='active'> Hotel Bookings </a></li>--}}
{{--                    <li><a href="/" class="routerLink" active-link='active'> Become A Partner </a></li>--}}
{{--                    <li><a href="{{url('parcel')}}" class="routerLink {{ (request()->is('parcel')) ? 'active-text' : '' }}"  active-link='active'> Send Parcel </a><span class="{{ (request()->is('parcel')) ? 'active-nav' : '' }}"></span></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--        <!-- Top Navigation Menu -->--}}

{{--    </div>--}}
{{--    <!--- mobile nav -->--}}

{{--    <!--Navbar-->--}}
{{--    <nav class="navbar navbar-light light-blue lighten-4">--}}

{{--        <!-- Navbar brand -->--}}
{{--        <div class="logo">--}}
{{--            <img  src={{asset('/images/logo/et-logo.png')}} alt="Etransit-logo"/>--}}
{{--        </div>--}}
{{--        <a class="navbar-brand" href="#">Navbar</a>--}}

{{--        <!-- Collapse button -->--}}
{{--        <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"--}}
{{--                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i--}}
{{--                    class="fas fa-bars fa-1x"></i></span></button>--}}

{{--        <!-- Collapsible content -->--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent1">--}}

{{--            <!-- Links -->--}}
{{--            <div class="nav-menu">--}}
{{--                <ul>--}}
{{--                    <li><a  href="/" class="routerLink" > Home </a></li>--}}
{{--                    <li><a href="/" class="routerLink"> About Us </a></li>--}}
{{--                    <li><a href="/" class="routerLink" > Tour Packages </a></li>--}}
{{--                    <li><a href="/" class="routerLink" > Boat Cruise </a></li>--}}
{{--                    <li><a href="/" class="routerLink" > Hotel Bookings </a></li>--}}
{{--                    <li><a href="/" class="routerLink" > Become A Partner </a></li>--}}
{{--                    <li><a href="/" class="routerLink"> Send Parcel </a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <!-- Links -->--}}

{{--        </div>--}}
{{--        <!-- Collapsible content -->--}}

{{--    </nav>--}}
{{--    <!--/.Navbar-->--}}


{{--    <!-- 3ne of mobile nav -->--}}
<section>
    <div id="topnav" style="height: 49px;background: #343f5f;">
        <div class="container">
            <div class="row" style="height: 49px;">
                <div class="col-sm-auto col-md-8 col-lg-8 col-xl-8 col-xxl-8" id="topparagrahp" style="height: 49px;">
                    <p id="faicon" style="text-align: center;color: var(--bs-white);margin-top: 9px;margin-left: 7px;width: 293.703px;margin-bottom: 22px;"><i class="fa fa-facebook" style="padding-top: 5px;"></i>&nbsp; &nbsp;&nbsp;<i class="fa fa-linkedin" style="color: rgb(255, 255, 255);padding-top: 5px;"></i>&nbsp; &nbsp; &nbsp;<i class="fa fa-google-plus justify-content-center align-items-center align-content-center" style="padding-top: 5px;"></i>&nbsp; &nbsp; |&nbsp; hello@etransitafrica.com&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                </div>
                <div class="col-auto col-sm-auto col-md-2 col-lg-2 col-xl-2 col-xxl-2" id="currency" style="text-align: center;">
                    <div class="dropdown" id="reducebutton-1" style="padding-top: 6px;padding-bottom: 6px;"><button class="btn btn-light dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" id="reducebutton-2" type="button" style="color: rgb(255,255,255);background: rgb(52,63,95);border-style: none;border-color: rgba(255,255,255,0);font-size: 12px;">NGN&nbsp;&nbsp;</button>
                        <div class="dropdown-menu dropdown-menu-start" id="reducebutton-3"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </div>
                </div>
                <div class="col-auto col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2" id="countrydiv" style="padding-right: 0px;padding-left: 5px;"><button class="btn btn-primary btn-lg text-start d-inline-flex" id="countrytext" type="button" style="margin: auto;width: 100%;color: var(--bs-white);margin-bottom: 2px;font-weight: 400;font-size: 14px;border-radius: 0px;background: rgba(247,247,247,0);border-style: none;border-color: rgba(255,255,255,0);padding-top: 12px;"><img src="{{asset('new-assets/img/uk.svg')}}" style="max-width: 24px;margin-right: 12px;">English</button></div>
            </div>
        </div>
    </div>
</section>
<section>
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container"><a class="navbar-brand" href="#"><img src="{{asset('new-assets/img/logofull%201.png')}}"></a><button data-bs-toggle="offcanvas" data-bs-target="#offcanvas-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="text-align: right;">
                <ul class="navbar-nav navbar-nav-scroll text-end d-md-flex ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#" style="color: #06044e;">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Tour Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Boat Cruise&nbsp;</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Car Hire</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Hotel Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Become A Partner</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #06044e;">Send Parcel</a></li>
                </ul>
            </div>
        </div>
    </nav>
</section>
