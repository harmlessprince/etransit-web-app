@extends('admin.layout.app')
<style>
    .trip-status_off{
        background: red;
        color:white;
        padding:5px;
        border-radius: 4px;
    }
    .trip-status_on{
        background: green;
        color:white;
        padding:5px;
        border-radius: 4px;
    }
</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">{{$car->tenant->display_name}} Car</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h4>Company Information</h4>
                             <hr>
                                <h6>
                                    {{$car->tenant->company_name}}
                                </h6>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h4>Vehicle Information</h4>
                                <hr>
                                <h6 >
                                 Car :   {{$car->car_name}}
                                </h6>
                                <hr>
                                <h6 >
                                  Registration :  {{$car->car_registration}}
                                </h6>
                                <hr>
                                <h6 >
                                  Transmission :  {{$car->transmission}}
                                </h6>
                                <hr>
                                <h6>
                                  Model:  {{$car->model_year}}
                                </h6>
                                <hr>
                                <h6>
                                    Class:  {{$car->carclass->name}}
                                </h6>
                                <hr>
                                <h6>
                                    Type :  {{$car->cartype->name}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col-xl-12 box-col-12 col-md-12">--}}
{{--                <button class="btn btn-success">Edit {{$carHistory->car_name}}</button>--}}
{{--                <br><br>--}}
{{--                <div class="card o-hidden">--}}
{{--                    <div class="card-header card-no-border">--}}
{{--                        <div class="media">--}}
{{--                            <div class="media-body">--}}
{{--                                <h5><span class="f-w-900 font-primary">{{$carHistory->car_name}}</span>  <span class="f-w-500 font-roboto">History</span></h5>--}}
{{--                                <br><br>--}}
{{--                                <table class="table table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th scope="col">#</th>--}}
{{--                                        <th scope="col">Payment Type</th>--}}
{{--                                        <th scope="col">Trip Status</th>--}}
{{--                                        <th scope="col">Booked</th>--}}
{{--                                        <th scope="col">Hired By</th>--}}
{{--                                        <th scope="col">Plan Amount</th>--}}
{{--                                        <th scope="col">Plan</th>--}}
{{--                                        <th scope="col">Extra Hour (Amount)</th>--}}
{{--                                        <th scope="col">Extra Hour (Minutes)</th>--}}
{{--                                        <th scope="col">Pick up Date</th>--}}
{{--                                        <th scope="col">Pick up time</th>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($histories as $index => $history)--}}
{{--                                        <tr>--}}
{{--                                            <th scope="row">{{$index+1}}</th>--}}
{{--                                            <td>--}}
{{--                                                {{$history->payment_status}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($history->available_status ==  'Off Trip')--}}
{{--                                                    <span class="trip-status_off">--}}
{{--                                                {{$history->available_status}}--}}
{{--                                               </span>--}}
{{--                                                @else--}}
{{--                                                    <span class="trip-status_on">--}}
{{--                                                {{$history->available_status}}--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($history->isConfirmed ==  'True')--}}
{{--                                                    <span class="trip-status_on">--}}
{{--                                                 {{$history->isConfirmed}}--}}
{{--                                               </span>--}}
{{--                                                @else--}}
{{--                                                    <span class="trip-status_off">--}}
{{--                                                 {{$history->isConfirmed}}--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>{{$history->user->email}}</td>--}}
{{--                                            <td>{{number_format($history->carplan->amount)}}</td>--}}
{{--                                            <td>{{$history->carplan->plan}}</td>--}}
{{--                                            <td>{{number_format($history->amount_to_remit_after_delayed_trip)}}</td>--}}
{{--                                            <td>{{$history->delayed_trip_in_minutes ?? 'Nil'}}</td>--}}
{{--                                            <td>{{$history->date->format('d M Y')}}</td>--}}
{{--                                            <td>{{$history->time}}</td>--}}

{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
