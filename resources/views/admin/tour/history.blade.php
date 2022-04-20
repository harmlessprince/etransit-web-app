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
    .addFlex{
        display:flex;
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
                        <li class="breadcrumb-item">
                            <a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Tour History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row addFlex">
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Total Bookings</span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">{{$transactionCount}}</h4>
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
                                <p><span class="f-w-500 font-roboto">Amount Booked</span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">{{$transactionSum}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{url('admin/edit/'. $tourHistory->id.'/tour')}}" class="btn btn-danger">Edit Tour</a>
        <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">

                <br><br>
                    <div class="card o-hidden">
                        <div class="card-header card-no-border">
                            <div class="media">
                                <div class="media-body">
                                    <h5>
{{--                                        <span class="f-w-900 font-primary">{{$carHistory->car_name}}</span>  --}}
                                        <span class="f-w-500 font-roboto">Tour History</span>
                                    </h5>
                                    <br><br>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Description</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $index => $transaction)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$transaction->user->full_name}}</td>
                                                <td>{{$transaction->user->email}}</td>
                                                <td>{{$transaction->user->phone_number}}</td>
                                                <td>{{$transaction->transaction_type}}</td>
                                                <td>{{number_format($transaction->amount)}}</td>
                                                <td>{{$transaction->status}}</td>
                                                <td> {{$transaction->description}} </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{$transactions->links()}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
