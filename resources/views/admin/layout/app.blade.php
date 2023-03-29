<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')
<body>
    <div id="pageloader">
        <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
     </div>
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
@include('admin.layout.navbar')
<!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
    @include('admin.layout.sidebar')
    <!-- Page Sidebar Ends-->
        <div class="page-body">
            @include('sweetalert::alert')
{{--            @include('sweetalert::alert')--}}
            @yield('content')
        </div>
        <!-- footer start-->
        @include('admin.layout.footer')
    </div>
</div>

<!-- login js-->
<!-- Plugin used-->
</body>
</html>
