@extends('Eticket.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }

    input:focus{
        outline:none !important;
    }
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    .add_bus_btn{
        display: flex;
        justify-content: flex-end;
    }
    .space-left{
        margin-left: 10px;
        margin-bottom:10px;
    }
    a{
        text-decoration: none !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">View Car Histories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
{{--        <div class="row three-row-grid">--}}
{{--            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">--}}
{{--                <a href="{{url('e-ticket/view-tenant-car-history/')}}">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="align-text">--}}
{{--                                --}}{{--                                <h1>{{$carHistories}}</h1>--}}
{{--                                <h6>Trip Histories</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="align-text">--}}
{{--                            <h1>100</h1>--}}
{{--                            <h6>Transaction(s)</h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Booked by</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Pick Up Date</th>
                                <th scope="col">Pick Up Time</th>
                                <th scope="col">Expected Return Date</th>
                                <th scope="col">Expected Return Time</th>
                                <th scope="col">Drop off Date</th>
                                <th scope="col">Drop off Time</th>
                                <th scope="col">Booking Confirmation</th>
                                <th scope="col">Booked At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carHistories as $index => $history)
                                <tr>
                                    <th scope="row">{{$index + 1}}</th>
                                    <td>{{$history->user->email}}</td>
                                    <td>{{$history->carplan->plan}}</td>
                                    <td>{{$history->payment_status}}</td>
                                    <td>{{$history->available_status}}</td>
                                    <td>{{$history->date->format('Y M d')}}</td>
                                    <td>{{$history->time}}</td>
                                    <td>{{$history->returnDate->format('Y M d')}}</td>
                                    <td>{{$history->returnTime}}</td>
                                    <td>{{$history->dropOffDate}}</td>
                                    <td>{{$history->dropOffTime}}</td>
                                    <td>{{$history->isConfirmed}}</td>
                                    <td>{{$history->created_at->diffforhumans()}}</td>
                                    <td><a href="{{url('e-ticket/view-history/'.$history->id)}}" class="btn btn-success btn-sm">View</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
