@extends('admin.layout.app')
<style>
.grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 10px;
}
.search_btn{
    grid-column: 2/4;
    justify-self: center;
}
.pagination_box{
    display:flex;
    justify-content: flex-end;
    margin-top:40px;
    margin-right:150px;
}
</style>
@section('content')

        <div class="container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-6">
                        <h3>{{env('APP_NAME')}}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Transactions</li>
                        </ol>
                    </div>
                </div>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card col-md-12 col-lg-12 col-sm-12 col-xl-12 col-xs-12">
                <div class="card-body">
                   <form action="{{url('admin/transactions')}}">
                       @csrf
                       <div class="grid">
                           <div>
                               <div class="form-group">
                                   <label>Start Date</label>
                                   <input type="date" class="form-control" name="start_date"/>
                               </div>
                               <div class="form-group">
                                   <label>End Date</label>
                                   <input type="date" class="form-control" name="end_date"/>
                               </div>
                           </div>

                           <div>
                               <div class="form-group">
                                   <label>Service Type</label>
                                   <select class="form-control" name="service_type">
                                       <option value="">Select Services</option>
                                       @foreach($serviceData as $service)
                                       <option value="{{$service['id']}}">{{$service['service']}}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Transaction Status</label>
                                   <select class="form-control" name="transaction_status">
                                       <option value="">Select Status</option>
                                       <option value="Successful">Successful</option>
                                       <option value="Pending">Pending</option>
                                       <option value="Likely Fraud">Likely Fraud</option>
                                   </select>
                               </div>
                           </div>
                           <div>
                               <div class="form-group">
                                   <label>Passenger Email</label>
                                   <input type="email" class="form-control" name="passenger_email"/>
                               </div>
                               <div class="form-group">
                                   <label>Transaction Reference</label>
                                   <input type="text" class="form-control" name="reference"/>
                               </div>
                           </div>
                           <div>
                               <div class="form-group">
                                   <label>Payment Type</label>
                                   <select class="form-control" name="payment_type">
                                       <option value="">Select Status</option>
                                       <option value="cash payment">Cash Payment</option>
                                       <option value="online">Card Payment</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Operator's Email</label>
                                   <input type="email" class="form-control" name="operator_email"/>
                               </div>
                           </div>
                           <div class="search_btn">
                               <button class="btn btn-success">Search Filter</button>
{{--                               <button class="btn btn-danger" onClick="refreshTransactionPage()">Reset Filter</button>--}}
                           </div>

                       </div>

                   </form>
                </div>
            </div>
            <div class="card col-md-12 col-lg-12 col-sm-12 col-xl-12 col-xs-12">
                <h3>Report Generation ( CSV )</h3>
                <div class="card-body">
                    <form action="{{url('admin/export-transaction')}}" onSubmit="exportTasks(event.target)">
                        @csrf
                        <div style="display:flex;justify-content: center;">
                            <div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" name="start_date"/>
                                </div>

                            </div>
                            <div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" name="end_date"/>
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label>Payment Type</label>
                                    <select class="form-control" name="payment_type">
                                        <option value="">Select Status</option>
                                        <option value="cash payment">Cash Payment</option>
                                        <option value="online">Card Payment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Operator's Email</label>
                                <input type="email" class="form-control" name="operator_email"/>
                            </div>
                            <div class="form-group">
                                <label>Set Paginator</label>
                                <input type="number" class="form-control" name="set_paginator"/>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center">
                            <button class="btn btn-success">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="transaction_table">
{{--                <span data-href="/admin/export-transaction" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span>--}}
                <div class="card col-md-12 col-lg-12 col-sm-12 col-xl-12 col-xs-12">
                    <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Service Type</th>
                        <th scope="col">Reference</th>
{{--                        <th scope="col">Flutterwave Reference</th>--}}
                        <th scope="col">Purchased By</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                      <tbody>
                          @foreach($transactions as $index => $transaction)
                                <tr>
                                    <th scope="row">{{$index + 1}}</th>
                                    <td>&#8358; {{number_format($transaction->amount)}}</td>
                                    <td>{{$transaction->service->name}}</td>
                                    <td>{{$transaction->reference}}</td>
{{--                                    <td>{{$transaction->trx_ref}}</td>--}}
                                    <td>{{$transaction->user->full_name}}</td>
                                    <td>{{$transaction->status}}</td>
                                    <td>{{$transaction->created_at->diffforhumans()}}</td>
                                    <td>
                                        <a  href="{{url('admin/view-transaction/'.$transaction->id)}}" class="btn btn-light"><i class="fas fa-eye"></i>View</a>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                 </div>
               </div>
            </div>
            <div>
                {{ $transactions->links() }}
            </div>
        </div>

@endsection

<script>
    function refreshTransactionPage(event)
    {
        event.preventDefault();
        console.log(e)
        alert('fff');

        // location.reload();
    }

    function exportTasks(_this) {
        let _url = $(_this).data('href');
        window.location.href = _url;
    }
</script>
