@extends('Eticket.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row size-column">
            <div class="col-xl-7 box-col-12 xl-100">
                <div class="row dash-chart">
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p><span class="f-w-500 font-roboto">Today Total sale</span><span class="f-w-700 font-primary ml-2">89.21%</span></p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">3000.56</span></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p><span class="f-w-500 font-roboto">Today Total visits</span><span class="f-w-700 font-primary ml-2">35.00%</span></p>
                                        <h4 class="f-w-500 mb-0 f-26 counter">9,050</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-body">
                                <div class="ecommerce-widgets media">
                                    <div class="media-body">
                                        <p class="f-w-500 font-roboto">Our Sale Value<span class="badge pill-badge-primary ml-3">New</span></p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">7454.25</span></h4>
                                    </div>
                                    <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="f-w-500 font-roboto">Today Stock value<span class="badge pill-badge-primary ml-3">Hot</span></p>
                                        <div class="progress-box">
                                            <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">9000.04</span></h4>
                                            <div class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                                                <div class="progress-gradient-primary" role="progressbar" style="width: 35%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="font-primary">88%</span><span class="animate-circle"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 box-col-12 xl-50">
                <div class="card o-hidden dash-chart">
                    <div class="card-header card-no-border">

                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Total Profit</span><span class="font-primary f-w-700 ml-2">99.00%</span></p>
                                <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">3000.56</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{count($users)}}
        </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection
