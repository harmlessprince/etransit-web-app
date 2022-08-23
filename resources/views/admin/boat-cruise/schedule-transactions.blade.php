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
                        <li class="breadcrumb-item">Boat Payment History</li>
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
                                <p><span class="f-w-500 font-roboto">Transaction Count</span></p>
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
                                <p><span class="f-w-500 font-roboto">Total Payment</span><span class="f-w-700 font-primary ml-2"></span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">{{$transactionSum }}</h4>
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
                                <h5><span class="f-w-900 font-primary">{{$schedules[0]->boat->name ?? 'Boat Schedules'}}</span>  <span class="f-w-500 font-roboto"> Payment History</span></h5>
                                <br><br>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Payment Type</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $index => $transaction)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>
                                                {{$transaction->user->full_name}}
                                            </td>
                                            <td>
                                                {{$transaction->user->email}}
                                            </td>
                                            <td>
                                                {{$transaction->user->phone_number}}
                                            </td>
                                            <td>{{$transaction->reference}}</td>
                                            <td>{{$transaction->amount}}</td>
                                            <td>{{$transaction->transaction_type}}</td>
                                            <td>{{$transaction->status}}</td>

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
