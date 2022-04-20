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
    h5{
        color:red;
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
        <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h5>Sender Details</h5>
                                <hr>
                                <h6>Name : {{$delivery->user->full_name}}</h6>
                                <hr>
                                <h6>Email : {{$delivery->user->email}}</h6>
                                <hr>
                                <h6> Phone Number : {{$delivery->user->phone_number}}</h6>
                                <hr>
                                <h5>Pick Up Details</h5>
                                <hr>
                                <h6>Pick Up State : {{$delivery->state->name}}</h6>
                                <hr>
                                <h6>Pick Up City : {{$delivery->city->name}}</h6>
                                <hr>
                                <h6>Sender Landmark : {{$delivery->sender_landmark}}</h6>
                                <hr>
                                <h6>Receiver Name : {{$delivery->sender_name}}</h6>
                                <hr>
                                <h6>Receiver Phone Number : {{$delivery->sender_phone_number}}</h6>
                                <hr>
                                <h5>Delivery State</h5>
                                <hr>
                                <h6>Delivery State : {{$delivery->delivery_state->name}}</h6>
                                <hr>
                                <h6>Delivery City : {{$delivery->delivery_city->name}}</h6>
                                <hr>
                                <h6>Receiver Landmark : {{$delivery->receiver_landmark}}</h6>
                                <hr>
                                <h6>Receiver Name : {{$delivery->receiver_name}}</h6>
                                <hr>
                                <h6>Receiver Phone Number : {{$delivery->receiver_phone_number}}</h6>
                                <hr>
                                <h5>Document Type</h5>
                                <hr>
                                <h6>Document Type : {{Ucfirst($delivery->parcel->type)}}</h6>
                                <hr>
                                <h5>Delivery Notes</h5>
                                <hr>
                                <h6>Notes : {{$delivery->notes ?? 'Nil'}}</h6>
                                <hr>
                                <h5>Dimension Chart</h5>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Height</th>
                                        <th scope="col">Length</th>
                                        <th scope="col">Width</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{$delivery->weight}}</td>
                                        <td>{{$delivery->height}}</td>
                                        <td>{{$delivery->length}}</td>
                                        <td>{{$delivery->width}}</td>
                                        <td>{{$delivery->quantity}}</td>
                                        <td>&#x20A6;{{number_format($delivery->amount)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
