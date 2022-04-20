<header class="main-nav">
    <div class="logo-wrapper"><a href="{{url('/admin/dashboard')}}">
            <img class="img-fluid for-light" src="{{asset('/images/logo/et-logo.png')}}" alt="">
            <img class="img-fluid for-dark"  src="{{asset('/images/logo/et-logo.png')}}"  alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i>
        </div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="{{url('/admin/dashboard')}}">
            <img class="img-fluid" src="{{asset('/images/logo/et-logo.png')}}" alt="">
        </a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <a href="{{url('/admin/dashboard')}}">
                            <img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt="">
                        </a>
                        <div class="mobile-back text-right"><span>Back</span>
                            <i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-title">
                        <div>
                            <h6>Dashboard</h6>
                        </div>
                    </li>
                    <li ><a class="nav-link" href="{{route('admin.dashboard')}}"><i data-feather="home"></i><span>Dashboard</span></a>

                    </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Bus Management</span></a>
                        <ul class="nav-submenu menu-content">
{{--                            <li><a href="{{url('/admin/manage/vehicle')}}">Manage Buses</a></li>--}}
                            <li><a href="{{url('/admin/manage/tenant-bus')}}">Manage Buses</a></li>
                            <li><a href="{{url('/admin/manage/bus-terminals')}}">Manage Bus Terminals</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Tour Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/tour')}}">Manage Tour</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Car Management </span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/cars')}}">Manage Car Hiring </a></li>
                            <li><a href="{{url('/admin/manage/car-class')}}">Manage Car Class </a></li>
                            <li><a href="{{url('/admin/manage/car-type')}}">Manage Car Type </a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Boat Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/boat-cruise')}}">Manage Boat Cruise</a></li>
                            <li><a href="{{url('/admin/manage/boat-location')}}">Add Cruise Location</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Parcel Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/parcel')}}">Parcel Type</a></li>
                            <li><a href="{{url('/admin/parcel/state/index')}}">Manage State</a></li>
                            <li><a href="{{url('/admin/manage/city')}}">Manage Cities</a></li>
                            <li><a href="{{url('/admin/manage/weight')}}">Manage Weight</a></li>
                            <li><a href="{{url('/admin/manage/height')}}">Manage Height</a></li>
                            <li><a href="{{url('/admin/manage/length')}}">Manage Length</a></li>
                            <li><a href="{{url('/admin/manage/width')}}">Manage Width</a></li>
                            <li><a href="{{url('/admin/manage/parcel/delivery/request')}}">View Parcel Delivery Request</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Ferry Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/ferry')}}">Add Ferry</a></li>
                            <li><a href="{{url('/admin/ferry/types')}}">Manage types</a></li>
                            <li><a href="{{url('/admin/ferry/locations')}}">Manage Location</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Train Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/train')}}">Manage Train</a></li>
                            <li><a href="{{url('/admin/train/class')}}">Manage Class</a></li>
                            <li><a href="{{url('/admin/manage/train/location')}}">Manage Location</a></li>
                            <li><a href="{{url('/admin/manage/train/routes-fare')}}">Manage Routes Fare</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Customers</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/customers')}}">Manage Customers</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Transactions</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/transactions')}}">Manage Transactions</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#">
                            <i data-feather="box"></i>
                            <span>Partners</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/all-partners')}}">Partners</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="box"></i><span>Operator</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{url('/admin/manage/operators')}}">All Operators</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="file-text"></i><span>Roles</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a class="" href="{{url('admin/roles')}}">All Roles</a> </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="#"><i data-feather="server"></i><span>Permissions</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a  href="{{url('admin/permissions')}}">All Permissions</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
