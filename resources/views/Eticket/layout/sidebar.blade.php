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
                    <li ><a class="nav-link" href="{{route('e-ticket.dashboard')}}"><i data-feather="home"></i><span>Dashboard</span></a>

                    </li>
                    @php
                        $tenant = \App\Models\Tenant::find(session()->get('tenant_id'));
                        $serviceArray = [];
                        foreach($tenant->services as $service)
                        {
                        array_push($serviceArray , $service->id);
                        }
                    @endphp

                    @if(in_array('1',$serviceArray))
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Bus Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/e-ticket/buses')}}">Manage Buses</a></li>
                            <li><a href="{{url('/e-ticket/drivers')}}">Manage Drivers</a></li>
                            <li><a href="{{url('/e-ticket/terminals')}}">Manage Terminals</a></li>
                            <li><a href="{{url('/e-ticket/locations')}}">Manage Locations</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(in_array('6',$serviceArray))
                        <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Car Management</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{url('/e-ticket/car-hire')}}">Manage Car</a></li>
                            </ul>
                        </li>
                    @endif
{{--                    @if(in_array('8',$serviceArray))--}}
{{--                        <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Tour Management</span></a>--}}
{{--                            <ul class="nav-submenu menu-content">--}}
{{--                                <li><a href="{{url('/e-ticket/tour-packages')}}">Manage Tour</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Staff Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/e-ticket/staffs')}}">Manage Staff</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Roles Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/e-ticket/roles')}}">Roles</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
