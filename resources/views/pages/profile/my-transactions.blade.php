@extends('layouts.app')
<style>
    .view_transactions {
        color: #f8a159;;
        text-decoration: none;
    }

    .view_transactions:hover {
        color:#f8a159;;
        text-decoration:none !important;
        cursor:pointer;
    }
    /*.filter_card{*/
    /*    border: 10px solid green;*/
    /*}*/
    .tranx_header{
        color:#fd7e14;
    }

    table.table-bordered > thead > tr > th{
        border:1px solid #fd7e14 !important;
    }
</style>
@section('content')
<div class="row" style="padding: 3px;">
    <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
        <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
            <div class="no_data_img">
                <div style="display:flex;justify-content: center;">
                  <div>
                      <h3 class="tranx_header">{{Ucfirst($service->name)}} Transactions</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <section style="margin-bottom: 20px;" id="profile">
        <div class="container">
            @if($service_id == 1)
                <div class="card">
                    <div class="card-body">
                         <div class="row d-lg-flex justify-content-lg-center">
                             <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" style="padding-left: 20px;padding-right: 20px;">
                                  <div class="row" style="padding: 3px;">
                                      @if(count($transactions) > 0)
                                       <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                                         <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                             <div class="no_data_img">
                                                 <div>
                                                 <table class="table table-striped">
                                                  <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Reference</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Payment Type</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">PickUp</th>
                                                        <th scope="col">Destination</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Details</th>
                                                    </tr>
                                                    </thead>
                                                         <tbody>
                                                    @foreach($transactions as $index => $transaction)
                                                        <tr>
                                                            <th scope="row">{{$index + 1}}</th>
                                                            <th scope="row">{{$transaction->reference}}</th>
                                                            <th scope="row">{{$transaction->status}}</th>
                                                            <th scope="row">{{$transaction->transaction_type}}</th>
                                                            <td>&#x20A6; {{number_format($transaction->amount)}}</td>
                                                            <td>{{ $transaction->schedule->pickup->location}}</td>
                                                            <td>{{ $transaction->schedule->destination->location}}</td>
                                                            <td>{{ $transaction->schedule->departure_date->format('Y F d')}}</td>
                                                            <td>{{ $transaction->schedule->departure_time}}</td>
                                                            <td>{{$transaction->description}}</td>
                                                        </tr>
                                                        @endforeach
                                                       </tbody>
                                                     </table>
                                                  </div>
                                              </div>
                                              {{$transactions->links()}}
                                          </div>
                                     </div>
                                      @else
                                          <div class="row" style="padding: 3px;">
                                              <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                                                  <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                                      <div class="no_data_img">
                                                          <div style="display:flex;justify-content: center;">
                                                              <div>
                                                                  <img src="{{asset('images/illustrations/empty_data.png')}}" width="400" height="300" alt="bus-image"/>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endif
                                  </div>
                              </div>
                         </div>
                    </div>
                </div>
            @elseif($service_id == 2)
            <h1>Train Booking</h1>
            @elseif($service_id == 3)
            <h1>Ferry Booking</h1>
            @elseif($service_id == 4)
                <h1>Flight Booking </h1>
            @elseif($service_id == 5)
                <h1>Hotel Booking</h1>
            @elseif($service_id == 6)
                <div class="card">
                    <div class="card-body">
                        <div class="row d-lg-flex justify-content-lg-center">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" style="padding-left: 20px;padding-right: 20px;">
                                <div class="row" style="padding: 3px;">
                                    @if(count($transactions) > 0)
                                        <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                                            <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                                <div class="no_data_img">
                                                    <div>
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Reference</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Payment Type</th>
                                                                <th scope="col">Amount</th>
                                                                <th scope="col">PickUp Date</th>
                                                                <th scope="col">Pickup Time</th>
                                                                <th scope="col">Plan</th>
                                                                <th scope="col">Details</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($transactions as $index => $transaction)
                                                                <tr>
                                                                    <th scope="row">{{$index + 1}}</th>
                                                                    <th scope="row">{{$transaction->reference}}</th>
                                                                    <th scope="row">{{$transaction->status}}</th>
                                                                    <th scope="row">{{$transaction->transaction_type}}</th>
                                                                    <td>&#x20A6; {{number_format($transaction->amount)}}</td>
                                                                    <td>{{ $transaction->carhistory->returnDate->format('Y F d')}}</td>
                                                                    <td>{{ $transaction->carhistory->returnTime->format('h:i:s')}}</td>
                                                                    <td>{{ $transaction->carhistory->carplan->plan}}</td>
                                                                    <td>{{$transaction->description}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{$transactions->links()}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="row" style="padding: 3px;">
                                            <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                                                <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                                    <div class="no_data_img">
                                                        <div style="display:flex;justify-content: center;">
                                                            <div>
                                                                <img src="{{asset('images/illustrations/empty_data.png')}}" width="400" height="300" alt="bus-image"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($service_id == 7)
                <h1>Boat Cruise</h1>
            @elseif($service_id == 8)
                <h1>Tour Packages</h1>
            @elseif($service_id == 9)
                <h1>Parcel</h1>
            @endif
        </div>
    </section>


@endsection
