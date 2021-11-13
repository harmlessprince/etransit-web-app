@extends('layouts.app')

@section('content')
    <div class="payment-box container">
       <div class="payment">
           <h3>PAYMENT</h3>
           <p>Hire Our vehicles for your various trips and occasion </p>

           <h5>SELECT PAYMENT METHOD</h5>
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
                           <h6>IKEJA TERMINAL</h6>
                           <p>Toyota Shuttle</p>
                       </div>
                   </div>
                   <div class="destination_container">
                       <div class="receipt-header-destination-box">
                           <div class="orange-dot"></div>
                           <div >
                               <small>From</small>
                               <h6>Abia</h6>
                           </div>
                       </div>
                        <div class="liner"></div>
                       <div class="receipt-header-destination-box">
                           <div class="orange-outer-line"></div>
                           <div >
                               <small>To</small>
                               <h6>Abia</h6>
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
                            <small>28 July 2021</small>
                        </div>
                       <div class="pickup_time">
                           <h6>TIME</h6>
                           <small>12:00</small>
                       </div>
                   </div>
                   <div class="passenger_details">
                       <div class="passengers_payment">
                           <h6>PASSENGERS</h6>
                           <p>3 Adult(s)</p>
                           <p> 1 Child</p>
                           <p>Discount</p>
                       </div>
                       <div class="transport_amount">
                           <h6>AMOUNT</h6>
                           <p>4000</p>
                           <p>1000</p>
                           <p>0%</p>
                       </div>
                   </div>
                   <hr>
                   <div class="receipt_total">
                       <div class="trip_total">
                           <h6>Total : N 10,000</h6>
                       </div>
                       <div class="seat_order">
                           Seat: 1A
                       </div>
                   </div>
                   <hr>
               </div>

           </div>
        </div>
    </div>
@endsection
