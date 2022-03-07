@extends('layouts.app')
<style>
    /*.round_trip{*/
    /*    display:grid;*/
    /*    grid-template-columns: repeat(5 , 1fr);*/

    /*}*/
    /*.round_trip .trip_type{*/
    /*    grid-column:1/5;*/
    /*}*/
    .select_payment{
        margin-left: 30px;
        margin-top: 20px;
    }

    .select_payment {
        padding: 10px;
        color: #DC6513;
        border: 1px solid #DC6513;
        width: 250px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
    }
    #cash_payment_option{
        margin-top:20px;
        display:none;
    }
    .cash_payment{
        color:#fff;

    }
    #online_payment{
        display:none;
    }
</style>
@section('content')
    <div class="payment-box container">
       <div class="payment">
           <h3>PAYMENT</h3>
           <p>Hire Our vehicles for your various trips and occasion </p>
           <h5>SELECT PAYMENT METHOD</h5>
           <div>
               <select class="select_payment" id="select_payment_option" onchange="changeFunc();">
                   <option value="0">Choose Payment Option</option>
                   <option value="1">Online Payment</option>
                   <option value="2">Cash Payment</option>
               </select>
           </div>


            <div class="payment_button" id="online_payment">
                <form method="POST" action="{{ route('pay') }}" id="paymentForm">
                    {{ csrf_field() }}

                    <input type="hidden" name="name" value="{{auth()->user()->full_name}}" placeholder="Name" />
                    <input type="hidden" name="email" type="email" value="{{auth()->user()->email}}" placeholder="Your Email" />
                    <input type="hidden" name="phone" type="tel" value="{{auth()->user()->phone_number}}" placeholder="Phone number" />
                    <input type="hidden" name="amount" value="{{$totalFare}}"/>
                    <input type="hidden" name="service" value="{{$fetchScheduleDetails->service->name}}" />
                    <input type="hidden" name="service_id" value="{{$fetchScheduleDetails->service->id}}" />
                    <input type="hidden" name="schedule_id" value="{{$fetchScheduleDetails->id}}" />
                    <input type="hidden" name="childrenCount" value="{{$childrenCount}}"/>
                    <input type="hidden" name="adultCount" value="{{$adultCount}}"/>
                    <input type="submit" value="Buy Ticket" />
                </form>
            </div>
           <div class="payment_button" id="cash_payment_option">
               <form method="POST" action="{{ url('bus/cash-payment') }}">
                   {{ csrf_field() }}

                   <input type="hidden" name="amount" value="{{$totalFare}}"/>
                   <input type="hidden" name="service" value="{{$fetchScheduleDetails->service->name}}"/>
                   <input type="hidden" name="service_id" value="{{$fetchScheduleDetails->service->id}}" />
                   <input type="hidden" name="schedule_id" value="{{$fetchScheduleDetails->id}}" />
                   <input type="hidden" name="childrenCount" value="{{$childrenCount}}" />
                   <input type="hidden" name="adultCount" value="{{$adultCount}}" />
                   <input type="submit" value="Pay With Cash" />
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
                   @if(!is_null($returnDate))
                     <div class="round_trip">
                         <div class="trip_type">
                             <h6>Type</h6>
                             <small>Round Trip</small>
                         </div>
                         <div>
                             <h6>Date</h6>
                             <small>{{$returnDate}}</small>
                         </div>
                     </div>
                   @endif
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
    <script type="text/javascript">

        function changeFunc() {
            var selectBox           = document.getElementById("select_payment_option");
            var selectedValue       = selectBox.options[selectBox.selectedIndex].value;
            var onlinePaymentOption = document.getElementById("online_payment");
            var payWithCash         = document.getElementById("cash_payment_option");


            if(selectedValue == 1)
            {
                onlinePaymentOption.style.display = 'block';
                payWithCash.style.display = 'none'

            }else if(selectedValue == 2)
            {
                onlinePaymentOption.style.display = 'none';
                payWithCash.style.display = 'block'

            }else{
                onlinePaymentOption.style.display = 'none';
                payWithCash.style.display = 'none'
            }
        }

    </script>
@endsection
