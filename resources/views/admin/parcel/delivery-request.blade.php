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
    .flexItem{
        display: flex;
        justify-content: space-between;
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Parcel Payment History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row flexItem">
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Parcel Count</span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">{{$deliveryParcelCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Total Payment</span><span class="f-w-700 font-primary ml-2"></span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">{{$deliveryParcelSum}}</h4>
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
{{--                                <h5><span class="f-w-900 font-primary">{{$schedules[0]->boat->name ?? 'Boat Schedules'}}</span>  <span class="f-w-500 font-roboto"> Payment History</span></h5>--}}
                                <br><br>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Pick Up State</th>
                                        <th scope="col">Pick Up City</th>
                                        <th scope="col">Delivery State</th>
                                        <th scope="col">Delivery City</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deliveries as $index => $delivery)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>
                                                {{$delivery->user->full_name}}
                                            </td>
                                            <td>
                                                {{$delivery->user->email}}
                                            </td>
                                            <td>
                                                {{$delivery->user->phone_number}}
                                            </td>
                                            <td>{{$delivery->state->name}}</td>
                                            <td>{{$delivery->city->name}}</td>
                                            <td>{{$delivery->delivery_state->name}}</td>
                                            <td>{{$delivery->delivery_city->name}}</td>
                                            <td><a href="{{url('admin/manage/view-parcel/delivery/request/'.$delivery->id)}}" class="btn btn-success btn-sm">View</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{$deliveries->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
