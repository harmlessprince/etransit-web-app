<style>
        .settings-dropdown{
           display: none;
           padding-left:25px;
           color: #007bdd;
        }
        .profile-dropdown:hover .settings-dropdown {
            display: block;
        }
        .settings-dropdown li a:hover {
            text-decoration: none;
            color: #6f42c1;
        }
</style>


<div class="page-main-header">
    <div class="main-header-right row m-0">
        <form class="form-inline search-full" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
        </div>
        <div class="left-menu-header col horizontal-wrapper pl-0">
            <ul class="horizontal-menu">
                <li class="mega-menu"><a class="nav-link" href="#"><i data-feather="layers"></i><span>{{env('APP_NAME')}}</span></a>
                </li>
            </ul>
        </div>
        <div class="nav-right col-8 pull-right right-menu">
            <ul class="nav-menus">
{{--                <li><span class="header-search"><i data-feather="search"></i></span></li>--}}
{{--                <li class="onhover-dropdown">--}}
{{--                    <div class="notification-box"><i data-feather="bell"></i><span class="badge badge-pill badge-secondary">4</span></div>--}}
{{--                    <ul class="notification-dropdown onhover-show-div">--}}
{{--                        <li class="bg-primary">--}}
{{--                            <h6 class="f-18 mb-0">Notitication</h6>--}}
{{--                            <p class="mb-0">You have 4 new notification</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p class="mb-0"><i class="fa fa-circle-o mr-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p class="mb-0"><i class="fa fa-circle-o mr-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p class="mb-0"><i class="fa fa-circle-o mr-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <p class="mb-0"><i class="fa fa-circle-o mr-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p>--}}
{{--                        </li>--}}
{{--                        <li><a class="btn btn-primary" href="#">Check all notification</a>--}}
{{--                            <!--a.f-15.f-w-500.txt-dark(href="#") Check all notification-->--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>

                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0">
                    <div class="media profile-media">
{{--                        <img class="b-r-10" src="../assets/images/dashboard/profile.jpg" alt="">--}}
                        <div class="media-body"><span>{{auth()->guard('e-ticket')->user()->full_name}}</span>
                            <p class="mb-0 font-roboto"><i class="middle fa fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li class="settings-btn"><i data-feather="settings"></i><span>Settings</span>
                            <div class="settings-dropdown">
                                <ul>
                                    <li><a href="{{url('/e-ticket/user-profile')}}">Edit Profile</a></li>
                                    <hr>
                                    <li class="mode">Appearance</li>
                                    <hr>
                                    <li><a href="{{url('/e-ticket/change-password')}}">Change Password</a></li>
                                    <hr>
                                </ul>
                            </div>                                        
                        </li>
                        <li><i data-feather="log-in"> </i><span>
                        <a href="{{ route('e-ticket.logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('e-ticket.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </span></li>
                    </ul>
                </li>
            </ul>
        </div>
        <script id="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
                <div class="ProfileCard-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0">
                        <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                        <polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                </div>
                <div class="ProfileCard-details">
                    <div class="ProfileCard-realName">some name</div>
                </div>
            </div>
        </script>
        <script id="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
        </script>
    </div>
</div>
