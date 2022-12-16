<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/images/site.webmanifest">

    <!-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"> -->
    <link rel="stylesheet" href="{{asset('new-assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arsenal&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;display=swap">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/material-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/typicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/fonts/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Brands.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/etransit-top-nav.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/etransit-vehicle-slide.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Etransitnews.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Form-Input.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">
    <link rel="stylesheet" href="{{asset('new-assets/css/Login-Form-Dark.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/MAV_LanguageSelectButton.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Modern-Contact-Form.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Responsive-Product-Slider.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Search-Input-Responsive-with-Icon.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Timeline-Steps.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css')}}">
    <link rel="stylesheet" href="{{asset('new-assets/css/Ultimate-Testimonial-Slider-BS5.css')}}">
    <link rel="stylesheet" href="{{asset("new-assets/owlcarousel/assets/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("new-assets/owlcarousel/assets/owl.theme.default.min.css")}}">
    {{--    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>--}}
    <link href="{{asset('css/font.css')}}" rel="stylesheet"/>

    <!-- Vendor CSS Files -->
    <link href="{{asset("assets2/vendor/aos/aos.css")}}" rel="stylesheet">
    <link href="{{asset("assets2/vendor/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet">
    <link href="{{asset("assets2/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets2/vendor/glightbox/css/glightbox.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets2/vendor/swiper/swiper-bundle.min.css")}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset("assets2/css/style.css")}}" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('new-assets/css/slick.css') }}"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('new-assets/css/slick-theme.css') }}"/>




    <style>
        html,body{
            overflow-x: hidden;
        }
        body{
            font-family: metropolis-regular , Sans-Serif;
        }
        h1, h2,h3,h4,h5,h6{
            font-family: metropolis-semi-bold , Sans-Serif;
        }
        @media only screen and (max-device-width: 412px) {
            .auth_class{
                display:none !important;
            }
        }
        .whatsappBtn{
            position:fixed;
            top:90%;
            left:90%;
            display:flex;
            justify-content: flex-end;
            margin-right:10px;
        }
    </style>


    {{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">--}}
    {{--    @stack('css')--}}
    {{--    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <!-- CSRF Token -->


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    @toastr_css

</head>
<body onload="busnav()">
<div>
    <div >
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?83488';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled":true,
        "chatButtonSetting":{
            "backgroundColor":"#4dc247",
            "ctaText":"",
            "borderRadius":"25",
            "marginLeft":"0",
            "marginBottom":"50",
            "marginRight":"50",
            "position":"right"
        },
        "brandSetting":{
            "brandName":"ETRANSIT",
            "brandSubTitle":"Typically replies within a day",
            "brandImg":"https://dynamic.brandcrowd.com/asset/merch/113e4f98-cc0b-424f-a8a1-52faa6d46410/signage.png?v=4&text=&w=400",
            "welcomeText":"Hi there!\nWelcome to Etransit Support",
            "messageText":"Hello, I have a question about Etransit",
            "backgroundColor":"#0a5f54",
            "ctaText":"Start Chat",
            "borderRadius":"25",
            "autoShow":false,
            "phoneNumber":"2347043274627"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
<script type="text/javascript" src="{{ asset('new-assets/js/slick.min.js') }}"></script>
@if(Auth::check())
    <script>
        function openPaymentHistory(){
            var win = window.open("{{ route('myProfile', auth()->user()->id) }}", "");
            win.showPayment();
            window.opener.child_ready(win)
            {
                win.showPayment();
            };
        }
    </script>
    <script>
        function collapse(id){

            const attr = $('#'+id).hasClass('d-none');

            if (attr === false) {
                $('#'+id).addClass('d-none');
            }else{
                $('#'+id).removeClass('d-none');
            }
        }
    </script>
@endif
</body>
</html>
