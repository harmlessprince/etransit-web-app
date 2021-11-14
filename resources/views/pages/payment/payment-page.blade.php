@extends('layouts.app')

@section('content')
    <div class="payment-box container">
       <div class="payment">
           <h3>PAYMENT</h3>
           <p>Hire Our vehicles for your various trips and occasion </p>

           <h5>SELECT PAYMENT METHOD</h5>
            <div class="payment_button">
                <form method="POST" action="{{ route('pay') }}" id="paymentForm">
                    {{ csrf_field() }}

                    <input type="hidden" name="name" value="{{auth()->user()->full_name}}" placeholder="Name" />
                    <input type="hidden" name="email" type="email" value="{{auth()->user()->email}}" placeholder="Your Email" />
                    <input type="hidden" name="phone" type="tel" value="{{auth()->user()->phone_number}}" placeholder="Phone number" />
                    <input type="hidden" name="amount" value="{{$totalFare}}"/>
                    <input type="hidden" name="service" value="{{$fetchScheduleDetails->service->name}}" />
                    <input type="hidden" name="schedule_id" value="{{$fetchScheduleDetails->id}}" />
                    <input type="hidden" name="childrenCount" value="{{$childrenCount}}"/>
                    <input type="hidden" name="adultCount" value="{{$adultCount}}"/>
                    <input type="submit" value="Buy Ticket" />
                </form>
            </div>
           <div class="payment_options">
               <img src="{{asset('images/icons/mastercard.png')}}" width="70" height="50"/>
               <img src="{{asset('images/icons/visa.png')}}" width="70" height="50"/>
           </div>
       </div>
        <div class="receipt-box">
           <div class="receipt-box-content">
               <div class="receipt-destination-box">
                   <div class="receipt-header">
                       <div class="receipt-header-image">
                           <img src="{{asset('images/icons/shuttle.png')}}" width="30" height="40" />
                       </div>
                       <div class="receipt-header-terminal">
                           <h6>{{$fetchScheduleDetails->terminal->terminal_name}}L</h6>
                           <p>{{$fetchScheduleDetails->bus->car_type}}</p>
                       </div>
                   </div>
                   <div class="destination_container">
                       <div class="receipt-header-destination-box">
                           <div class="orange-dot"></div>
                           <div >
                               <small>From</small>
                               <h6>{{$fetchScheduleDetails->pickup->location}}</h6>
                           </div>
                       </div>
                        <div class="liner"></div>
                       <div class="receipt-header-destination-box">
                           <div class="orange-outer-line"></div>
                           <div >
                               <small>To</small>
                               <h6>{{$fetchScheduleDetails->destination->location}}</h6>
                           </div>
                           <div class="arrow_up">
                               <img src="{{asset('images/icons/arrow_down.png')}}" />
                               <img src="{{asset('images/icons/arrow_up.png')}}" />
                           </div>

                       </div>
                   </div>
               </div>
               <div class="receipt-calc-box">
                   <div class="receipt_date">
                        <div class="pickup_date">
                            <h6>DATE</h6>
                            <small>{{$fetchScheduleDetails->departure_date->format('d M Y')}}</small>
                        </div>
                       <div class="pickup_time">
                           <h6>TIME</h6>
                           <small>{{$fetchScheduleDetails->departure_time}}</small>
                       </div>
                   </div>
                   <div class="passenger_details">
                       <div class="passengers_payment">
                           <h6>PASSENGERS</h6>
                           @if($adultCount > 0)
                           <p>{{$adultCount}} Adult(s)</p>
                           @endif
                           @if($childrenCount > 0)
                           <p> {{$childrenCount}} Child(ren)</p>
                           @endif
                           <p>Discount</p>
                       </div>
                       <div class="transport_amount">
                           <h6>AMOUNT</h6>
                           @if($adultCount > 0)
                           <p>{{number_format($fetchScheduleDetails->fare_adult)}}</p>
                           @endif
                           @if($childrenCount > 0)
                           <p>{{number_format($fetchScheduleDetails->fare_children)}}</p>
                           @endif
                           <p>0%</p>
                       </div>
                   </div>
                   <hr>
                   <div class="receipt_total">
                       <div class="trip_total">
                           <h6>Total : &#x20A6; {{number_format($totalFare)}}</h6>
                       </div>
                       <div class="seat_order">
                           Seat : @foreach($selectedSeat as $seat) {{$seat->seat_position}} , @endforeach
                       </div>
                   </div>
                   <hr>
                   <div class="barcode_receipt">
                       <div class="barcode_img">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>
                   </div>
                   <div class="receipt_validity">
                       <small>Valid till Tuesday 28th after purchase</small>
                   </div>
               </div>

           </div>
        </div>
    </div>
@endsection
