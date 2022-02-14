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
            <div class="card col-md-12 col-lg-12 col-sm-12 col-xl-12 col-xs-12">
                <div class="card-body">
                   <form>
                       <div class="grid">
                           <div>
                               <div class="form-group">
                                   <label>Start Date</label>
                                   <input type="date" class="form-control" name="start_date"/>
                               </div>
                               <div class="form-group">
                                   <label>End Date</label>
                                   <input type="date" class="form-control" name="start_date"/>
                               </div>
                           </div>

                           <div>
                               <div class="form-group">
                                   <label>Service Type</label>
                                   <select class="form-control" name="service_type">
                                       <option value="">Select Services</option>
                                       <option value="">Bus Booking</option>
                                       <option value="successful">Flight Booking</option>
                                       <option value="cancelled">Ferry Booking</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Transaction Status</label>
                                   <select class="form-control" name="transaction_status">
                                       <option value="">Select Status</option>
                                       <option value="successful">Successful</option>
                                       <option value="cancelled">Cancelled</option>
                                       <option value="failed">Failed</option>
                                       <option value="fraud-detected">Likely Fraud</option>
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
                                   <input type="text" class="form-control" name="start_date"/>
                               </div>
                           </div>
                           <div>
                               <div class="form-group">
                                   <label>Flutterwave Trasanction Reference</label>
                                   <input type="tx_reference" class="form-control" name="passenger_email"/>
                               </div>
                               <div class="form-group">
                                   <label>Reference</label>
                                   <input type="text" class="form-control" name="start_date"/>
                               </div>
                           </div>
                           <div class="search_btn">
                               <button class="btn btn-success">Search Filter</button>
                               <button class="btn btn-danger">Reset Filter</button>
                           </div>

                       </div>

                   </form>
                </div>
            </div>

            <div class="transaction_table">
                <div class="card col-md-12 col-lg-12 col-sm-12 col-xl-12 col-xs-12">
                    <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Service Type</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Flutterwave Reference</th>
                        <th scope="col">Purchased By</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
{{--                    @if(count($transactions) > 0)--}}
                      <tbody>
                          @foreach($transactions as $index => $transaction)
                                <tr>
                                    <th scope="row">{{$index + 1}}</th>
                                    <td>&#8358; {{number_format($transaction->amount)}}</td>
                                    <td>{{$transaction->service->name}}</td>
                                    <td>{{$transaction->reference}}</td>
                                    <td>{{$transaction->trx_ref}}</td>
                                    <td>{{$transaction->user->full_name}}</td>
                                    <td>{{$transaction->status}}</td>
                                    <td>{{$transaction->created_at->diffforhumans()}}</td>
                                    <td>
                                        <a  href="{{url('admin/view-transaction/'.$transaction->id)}}" class="btn btn-light"><i class="fas fa-eye"></i>View</a>
                                    </td>
                                </tr>
                            @endforeach
{{--                      @else--}}
{{--                       --}}
{{--                            <div class="no_data_img">--}}
{{--                                <img src="{{asset('images/illustrations/empty_data.png')}}" width="400" height="300" alt="bus-image"/>--}}
{{--                            </div>--}}

                    </tbody>
{{--                    @endif--}}
                </table>
            </div>
        </div>
            </div>
        </div>


@endsection
