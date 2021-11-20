<header class="main-nav">
    <div class="logo-wrapper"><a href="{{url('/admin/dashboard')}}"><img class="img-fluid for-light" src="{{asset('/images/logo/et-logo.png')}}" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="{{url('/admin/dashboard')}}"><img class="img-fluid" src="{{asset('/images/logo/et-logo.png')}}" alt=""></a></div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn"><a href="{{url('/admin/dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                        <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-title">
                        <div>
                            <h6>Dashboard</h6>
                        </div>
                    </li>
                    <li ><a class="nav-link" href="{{route('admin.dashboard')}}"><i data-feather="home"></i><span>Dashboard</span></a>

                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="airplay"></i><span class="lan-6">Widgets</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="general-widget.html">General</a></li>
                            <li><a href="chart-widget.html">Chart</a></li>
                        </ul>
                    </li>

{{--                    <li class="sidebar-title">--}}
{{--                        <div>--}}
{{--                            <h6 >Service Management</h6>--}}
{{--                            <p >Manage {{env('APP_NAME')}} services</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Services</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/vehicle')}}">Manage Bus Ticketing</a></li>
                            <li><a href="projectcreate.html">Manage Train Ticketing</a></li>
                            <li><a href="projectcreate.html">Manage Car Hire</a></li>
                            <li><a href="projectcreate.html">Manage Train Ticketing</a></li>
                            <li><a href="projectcreate.html">Manage Plane Ticketing</a></li>
                            <li><a href="projectcreate.html">Manage Car Hiring</a></li>
                        </ul>
                    </li>
{{--                    <li class="sidebar-title">--}}
{{--                        <div>--}}
{{--                            <h6>Schedule</h6>--}}
{{--                            <p>Services schedule </p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Bus Schedules</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="state-color.html">Schedules</a></li>

                        </ul>
                    </li>
{{--                    <li class="sidebar-title">--}}
{{--                        <div>--}}
{{--                            <h6 >Vehicle Management</h6>--}}
{{--                            <p >Manage {{env('APP_NAME')}} vehicles</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Bus Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/vehicle')}}">Manage Buses</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Car Hire </span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/cars')}}">Manage Car Hiring </a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Transactions</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/transactions')}}">Manage Transactions</a></li>
                        </ul>
                    </li>
{{--                    <li class="sidebar-title">--}}
{{--                        <div>--}}
{{--                            <h6 >Terminal Management</h6>--}}
{{--                            <p >Manage {{env('APP_NAME')}} Terminals</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Terminals</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/terminals')}}">All Terminals</a></li>
                        </ul>
                    </li>
{{--                    <li class="sidebar-title">--}}
{{--                        <div>--}}
{{--                            <h6>Roles Management</h6>--}}
{{--                            <p>Roles management </p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="file-text"></i><span>Roles</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a class="" href="#">All Roles</a> </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="server"></i><span>Permissions</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a  href="#">All Permissions</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
