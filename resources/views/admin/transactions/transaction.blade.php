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
                    <div class="col-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark pull-right">
                            <ul>
                                <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                                <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                                <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                                <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form" action="#" method="get">
                                        <div class="form-group form-control-search">
                                            <div class="Typeahead Typeahead--twitterUsers">
                                                <div class="u-posRelative">
                                                    <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search.." name="q" title="" autofocus>
                                                    <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                                                </div>
                                                <div class="Typeahead-menu"></div>
                                                <script id="result-template" type="text/x-handlebars-template">
                                                    <div class="ProfileCard u-cf">
                                                        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                                                        <div class="ProfileCard-details">
                                                            <div class="ProfileCard-realName">some name</div>
                                                        </div>
                                                    </div>
                                                </script>
                                                <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
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
                        <th scope="col">Passenger Count</th>
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
                                    <td>{{$transaction->passenger_count}}</td>
                                    <td>{{$transaction->reference}}</td>
                                    <td>{{$transaction->trx_ref}}</td>
                                    <td>{{$transaction->user->full_name}}</td>
                                    <td>{{$transaction->status}}</td>
                                    <td>{{$transaction->created_at->diffforhumans()}}</td>
                                    <td>
                                        <img src="{{asset('images/icons/view.png')}}"  alt="view-icon"/>
{{--                                        <img src="{{asset('images/icons/edit.png')}}"  alt="view-icon"/>--}}
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
