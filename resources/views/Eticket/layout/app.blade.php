<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')
<body>
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
@include('Eticket.layout.navbar')
<!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
    @include('Eticket.layout.sidebar')
    <!-- Page Sidebar Ends-->
        <div class="page-body">
            @include('sweetalert::alert')
{{--                        @include('sweetalert::alert')--}}
            @yield('content')
        </div>
        <!-- footer start-->
        @include('Eticket.layout.footer')
    </div>
</div>

<!-- login js-->
<!-- Plugin used-->
</body>
</html>
