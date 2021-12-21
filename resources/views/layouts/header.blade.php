
    <div>
        <header class="navigation-header">
            <div class="nav-content">
                <div class="socials-block">
                    <div class="social-icons">
                        <!--                        <img :src="'/images/socials/facebook.png'"  alt="facebook-img"/>-->
                        <!--                        <img :src="'/images/socials/linkedin.png'"  alt="linkedin-img"/>-->
                        <!--                        <img :src="'/images/socials/google.png'"  alt="google-plus-img"/>-->
                    </div>
                    <!--                    <div class="breaker">-->
                    <!--                    </div>-->
                    <div class="email-container">
                        <span>example@email.com</span>
                    </div>
                </div>
                <div class="currency-block">
                    <span>NGN</span>
                    <span>English</span>
                    @if(!Auth::check())
                    <a href="{{url('/login')}}">
                        <button  class="login">Login</button>
                    </a>
                    <a href="{{url('/register')}}">
                        <button class="sign-up">Sign Up</button>
                    </a>
                    @else
                        <a href="{{ url('/logout') }}"  onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        <button class="sign-up">Sign Out</button>
                        </a>
                    @endif
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>
        <nav class="bottom-nav">
            <div class="logo">
                <img  src={{asset('/images/logo/et-logo.png')}} alt="Etransit-logo"/>
            </div>
            <div class="nav-menu">
                <ul>
                    <li><a  href="/" class="routerLink {{ (request()->is('/')) ? 'active-text' : '' }}" active-link='active'> Home </a><span class="{{ (request()->is('/')) ? 'active-nav' : '' }}"></span></li>
                    <li><a href="#about_us_section" class="routerLink" active-link='active' > About Us </a></li>
                    <li><a href="{{url('tour-packages')}}" class="routerLink {{ (request()->is('tour-packages')) ? 'active-text' : '' }}" active-link='active'> Tour Packages </a><span class="{{ (request()->is('tour-packages')) ? 'active-nav' : '' }}"></span></li>
                    <li><a href="{{url('boat-cruise')}}" class="routerLink {{ (request()->is('boat-cruise')) ? 'active-text' : '' }}" active-link='active'> Boat Cruise </a><span class="{{ (request()->is('boat-cruise')) ? 'active-nav' : '' }}"></span></li>
                    <li><a href="{{url('car-hire')}}" class="routerLink {{ (request()->is('car-hire')) ? 'active-text' : '' }}" active-link='active'> Hire A Vehicle </a> <span class="{{ (request()->is('car-hire')) ? 'active-nav' : '' }}"></span></li>
                    <li><a href="/" class="routerLink" active-link='active'> Hotel Bookings </a></li>
                    <li><a href="/" class="routerLink" active-link='active'> Become A Partner </a></li>
                    <li><a href="/" class="routerLink" active-link='active'> Send Parcel </a></li>
                </ul>
            </div>
        </nav>
        <!-- Top Navigation Menu -->

    </div>
    <!--- mobile nav -->

    <!--Navbar-->
    <nav class="navbar navbar-light light-blue lighten-4">

        <!-- Navbar brand -->
        <div class="logo">
            <img  src={{asset('/images/logo/et-logo.png')}} alt="Etransit-logo"/>
        </div>
{{--        <a class="navbar-brand" href="#">Navbar</a>--}}

        <!-- Collapse button -->
        <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i
                    class="fas fa-bars fa-1x"></i></span></button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">

            <!-- Links -->
            <div class="nav-menu">
                <ul>
                    <li><a  href="/" class="routerLink" > Home </a></li>
                    <li><a href="/" class="routerLink"> About Us </a></li>
                    <li><a href="/" class="routerLink" > Tour Packages </a></li>
                    <li><a href="/" class="routerLink" > Boat Cruise </a></li>
                    <li><a href="/" class="routerLink" > Hotel Bookings </a></li>
                    <li><a href="/" class="routerLink" > Become A Partner </a></li>
                    <li><a href="/" class="routerLink"> Send Parcel </a></li>
                </ul>
            </div>
            <!-- Links -->

        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->


    <!-- 3ne of mobile nav -->
