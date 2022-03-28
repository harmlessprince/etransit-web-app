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
{{--    <div class="payment-box container">--}}
{{--       <div class="payment">--}}
{{--           <h3>PAYMENT</h3>--}}
{{--           <p>Hire Our vehicles for your various trips and occasion </p>--}}
{{--           <h5>SELECT PAYMENT METHOD</h5>--}}
{{--           <div>--}}
{{--               <select class="select_payment" id="select_payment_option" onchange="changeFunc();">--}}
{{--                   <option value="0">Choose Payment Option</option>--}}
{{--                   <option value="1">Online Payment</option>--}}
{{--                   <option value="2">Cash Payment</option>--}}
{{--               </select>--}}
{{--           </div>--}}


{{--            <div class="payment_button" id="online_payment">--}}
{{--                <form method="POST" action="{{ route('pay') }}" id="paymentForm">--}}
{{--                    {{ csrf_field() }}--}}

{{--                    <input type="hidden" name="name" value="{{auth()->user()->full_name}}" placeholder="Name" />--}}
{{--                    <input type="hidden" name="email" type="email" value="{{auth()->user()->email}}" placeholder="Your Email" />--}}
{{--                    <input type="hidden" name="phone" type="tel" value="{{auth()->user()->phone_number}}" placeholder="Phone number" />--}}
{{--                    <input type="hidden" name="amount" value="{{$totalFare}}"/>--}}
{{--                    <input type="hidden" name="service" value="{{$fetchScheduleDetails->service->name}}" />--}}
{{--                    <input type="hidden" name="service_id" value="{{$fetchScheduleDetails->service->id}}" />--}}
{{--                    <input type="hidden" name="schedule_id" value="{{$fetchScheduleDetails->id}}" />--}}
{{--                    <input type="hidden" name="childrenCount" value="{{$childrenCount}}"/>--}}
{{--                    <input type="hidden" name="adultCount" value="{{$adultCount}}"/>--}}
{{--                    <input type="submit" value="Buy Ticket" />--}}
{{--                </form>--}}
{{--            </div>--}}
{{--           <div class="payment_button" id="cash_payment_option">--}}
{{--               <form method="POST" action="{{ url('bus/cash-payment') }}">--}}
{{--                   {{ csrf_field() }}--}}

{{--                   <input type="hidden" name="amount" value="{{$totalFare}}"/>--}}
{{--                   <input type="hidden" name="service" value="{{$fetchScheduleDetails->service->name}}"/>--}}
{{--                   <input type="hidden" name="service_id" value="{{$fetchScheduleDetails->service->id}}" />--}}
{{--                   <input type="hidden" name="schedule_id" value="{{$fetchScheduleDetails->id}}" />--}}
{{--                   <input type="hidden" name="childrenCount" value="{{$childrenCount}}" />--}}
{{--                   <input type="hidden" name="adultCount" value="{{$adultCount}}" />--}}
{{--                   <input type="submit" value="Pay With Cash" />--}}
{{--               </form>--}}
{{--           </div>--}}
{{--           <div class="payment_options">--}}
{{--               <img src="{{asset('images/icons/mastercard.png')}}" width="70" height="50"/>--}}
{{--               <img src="{{asset('images/icons/visa.png')}}" width="70" height="50"/>--}}
{{--           </div>--}}
{{--       </div>--}}
{{--        <div class="receipt-box">--}}
{{--           <div class="receipt-box-content">--}}
{{--               <div class="receipt-destination-box">--}}
{{--                   <div class="receipt-header">--}}
{{--                       <div class="receipt-header-image">--}}
{{--                           <img src="{{asset('images/icons/shuttle.png')}}" width="30" height="40" />--}}
{{--                       </div>--}}
{{--                       <div class="receipt-header-terminal">--}}
{{--                           <h6>{{$fetchScheduleDetails->terminal->terminal_name}}</h6>--}}
{{--                           <p>{{$fetchScheduleDetails->bus->car_type}}</p>--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--                   <div class="destination_container">--}}
{{--                       <div class="receipt-header-destination-box">--}}
{{--                           <div class="orange-dot"></div>--}}
{{--                           <div >--}}
{{--                               <small>From</small>--}}
{{--                               <h6>{{$fetchScheduleDetails->pickup->location}}</h6>--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                        <div class="liner"></div>--}}
{{--                       <div class="receipt-header-destination-box">--}}
{{--                           <div class="orange-outer-line"></div>--}}
{{--                           <div >--}}
{{--                               <small>To</small>--}}
{{--                               <h6>{{$fetchScheduleDetails->destination->location}}</h6>--}}
{{--                           </div>--}}
{{--                           <div class="arrow_up">--}}
{{--                               <img src="{{asset('images/icons/arrow_down.png')}}" />--}}
{{--                               <img src="{{asset('images/icons/arrow_up.png')}}" />--}}
{{--                           </div>--}}

{{--                       </div>--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--               <div class="receipt-calc-box">--}}
{{--                   <div class="receipt_date">--}}
{{--                        <div class="pickup_date">--}}
{{--                            <h6>DATE</h6>--}}
{{--                            <small>{{$fetchScheduleDetails->departure_date->format('d M Y')}}</small>--}}
{{--                        </div>--}}
{{--                       <div class="pickup_time">--}}
{{--                           <h6>TIME</h6>--}}
{{--                           <small>{{$fetchScheduleDetails->departure_time}}</small>--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--                   @if(!is_null($returnDate))--}}
{{--                     <div class="round_trip">--}}
{{--                         <div class="trip_type">--}}
{{--                             <h6>Type</h6>--}}
{{--                             <small>Round Trip</small>--}}
{{--                         </div>--}}
{{--                         <div>--}}
{{--                             <h6>Date</h6>--}}
{{--                             <small>{{$returnDate}}</small>--}}
{{--                         </div>--}}
{{--                     </div>--}}
{{--                   @endif--}}
{{--                   <div class="passenger_details">--}}
{{--                       <div class="passengers_payment">--}}
{{--                           <h6>PASSENGERS</h6>--}}
{{--                           @if($adultCount > 0)--}}
{{--                           <p>{{$adultCount}} Adult(s)</p>--}}
{{--                           @endif--}}
{{--                           @if($childrenCount > 0)--}}
{{--                           <p> {{$childrenCount}} Child(ren)</p>--}}
{{--                           @endif--}}
{{--                           <p>Discount</p>--}}
{{--                       </div>--}}
{{--                       <div class="transport_amount">--}}
{{--                           <h6>AMOUNT</h6>--}}
{{--                           @if($adultCount > 0)--}}
{{--                           <p>{{number_format($fetchScheduleDetails->fare_adult)}}</p>--}}
{{--                           @endif--}}
{{--                           @if($childrenCount > 0)--}}
{{--                           <p>{{number_format($fetchScheduleDetails->fare_children)}}</p>--}}
{{--                           @endif--}}
{{--                           <p>0%</p>--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--                   <hr>--}}
{{--                   <div class="receipt_total">--}}
{{--                       <div class="trip_total">--}}
{{--                           <h6>Total : &#x20A6; {{number_format($totalFare)}}</h6>--}}
{{--                       </div>--}}
{{--                       <div class="seat_order">--}}
{{--                           Seat : @foreach($selectedSeat as $seat) {{$seat->seat_position}} , @endforeach--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--                   <hr>--}}
{{--                   <div class="barcode_receipt">--}}
{{--                       <div class="barcode_img">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>--}}
{{--                   </div>--}}
{{--                   <div class="receipt_validity">--}}
{{--                       <small>Valid till Tuesday 28th after purchase</small>--}}
{{--                   </div>--}}
{{--               </div>--}}

{{--           </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<section style="padding-left: 0px;background: var(--bs-gray-100);">
    <div class="container">
        <div class="row">
            <div class="col-sm-6" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);">
                <div class="row">
                    <div class="col-12">
                        <h6 style="padding-left: 10px;">PAYMENT</h6>
                    </div>
                    <div class="col-12" style="padding-right: 0px;padding-left: 0px;text-align: left;">
                        <ul>
                            <li>Hire our vehicles for your various trips and occasion</li>
                        </ul>
                    </div>
                    <div class="col-12" style="padding-right: 0px;padding-left: 0px;margin-top: 40px;">
                        <p style="padding-left: 27px;">SELECT PAYMENT METHOD</p>
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
                    </div>
                    <div class="col-12" style="padding-right: 0px;padding-left: 0px;margin-top: 15px;">
                        <div class="row">
                            <div class="col-4" style="text-align: center;"><img src="{{asset('new-assets/img/MasterCard_Logo%201.svg')}}"></div>
                            <div class="col-8"><img src="{{asset('new-assets/img/favpng_visa-debit-card-credit-card-logo-mastercard%201%20(1).svg')}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" id="secondtab" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;">
                <div class="row" style="margin-top: 0px;padding: 24px;box-shadow: 1px 1px 6px rgb(231,231,231);border-left-width: 1px;border-radius: 10px;width: 285px;margin-left: 13px;padding-left: 0px;padding-right: 0px;padding-top: 11px;background: #f8f9fa;padding-bottom: 0px;">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2" style="text-align: left;padding-left: 5px;padding-right: 5px;"><i class="fas fa-bus" style="border-radius: 20px;color: rgb(255,255,255);background: #f8a159;border: 10px solid #f8a159 ;"></i></div>
                            <div class="col" style="text-align: left;"><span class="d-block" style="color: rgb(52,63,95);font-size: 14px;">
                                    <strong>{{strtoupper($fetchScheduleDetails->terminal->terminal_name)}}</strong></span>
                                <span class="d-block" style="color: var(--bs-gray);font-size: 14px;">{{$fetchScheduleDetails->bus->car_type}}</span></div>
                        </div>
                    </div>
                    <div class="col-12" style="padding-left: 0px;">
                        <ul class="timeline" style="border-color: rgb(248,161,89);margin-left: -4.7031px;">
                            <li class="from">
                                <span class="d-block" style="font-size: 12px;color: var(--bs-gray-500);text-align: left;">From</span>
                                <span class="d-block" style="margin-bottom: 3px;text-align: left;">{{$fetchScheduleDetails->pickup->location}}</span>
                                <span class="d-block" id="to" style="font-size: 12px;color: var(--bs-gray-500);margin-top: 4px;">To</span></li>
                            <li class="to"><span class="d-block" style="margin-top: 0px;padding-top: 0px;text-align: left;">{{$fetchScheduleDetails->destination->location}}&nbsp;</span></li>
                        </ul><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-down-up" id="directing" style="font-size: 23px;">
                            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"></path>
                        </svg>
                        <hr id="linecut" style="width: 259px;">
                    </div>
                    <div class="col-12" style="border-top-left-radius: 16px;border-top-right-radius: 20px;background: var(--bs-white);box-shadow: 1px 0px 8px rgb(227,227,228);">
                        <div class="table-responsive fs-6" style="font-size: 14px;border-bottom-width: 1px;border-bottom-style: dashed;">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td style="font-size: 12px;color: var(--bs-gray-600);text-align: left;"><strong>DATE</strong></td>
                                    <td style="font-size: 12px;color: var(--bs-gray-600);"><strong>TIME</strong></td>
                                </tr>
                                <tr>
                                    <td style="color: var(--bs-gray-600);font-size: 12px;text-align: left;">{{$fetchScheduleDetails->departure_date->format('d M Y')}}</td>
                                    <td style="color: var(--bs-gray-600);font-size: 12px;">{{$fetchScheduleDetails->departure_time}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px;color: var(--bs-gray-600);text-align: left;"><strong>PASSENGERS</strong></td>
                                    <td style="font-size: 12px;color: var(--bs-gray-600);"><strong>AMOUNT</strong></td>
                                </tr>
                                <tr>
                                    @if($adultCount > 0)
                                    <td style="color: var(--bs-gray-600);font-size: 12px;text-align: left;">{{$adultCount}} Adult (s)</td>
                                    <td style="color: var(--bs-gray-600);font-size: 12px;">{{number_format($fetchScheduleDetails->fare_adult)}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($childrenCount > 0)
                                        <td style="color: var(--bs-gray-600);font-size: 12px;text-align: left;">{{$childrenCount}} Adult (s)</td>
                                        <td style="color: var(--bs-gray-600);font-size: 12px;">{{number_format($fetchScheduleDetails->fare_children)}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td style="color: var(--bs-gray-600);font-size: 12px;text-align: left;"><strong>DISCOUNT</strong></td>
                                    <td style="color: var(--bs-gray-600);font-size: 12px;"><strong>0%</strong></td>
                                </tr>
                                @if(!is_null($returnDate))
                                    <tr>
                                        <td style="font-size: 12px;color: var(--bs-gray-600);text-align: left;"><strong>Type</strong></td>
                                        <td style="font-size: 12px;color: var(--bs-gray-600);text-align: left;"><strong>Date</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="color: var(--bs-gray-600);font-size: 12px;text-align: left;">Round Trip</td>
                                        <td style="color: var(--bs-gray-600);font-size: 12px;">{{$returnDate}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6" style="padding-right: 0px;border-bottom-width: 1px;border-bottom-style: none;background: var(--bs-white);">
                        <h6 style="border-bottom-width: 1px;border-bottom-style: dashed;padding-top: 10px;padding-bottom: 10px;color: rgb(52,63,95);"><strong>Total: &#x20A6; {{number_format($totalFare)}}</strong></h6>
                    </div>
                    <div class="col-6" style="padding-left: 0px;background: var(--bs-white);">
                        <h6 class="text-center" style="border-bottom-width: 1px;border-bottom-style: dashed;padding-top: 10px;padding-bottom: 10px;color: rgb(52,63,95);"><strong>Seat No: @foreach($selectedSeat as $seat) {{$seat->seat_position}} , @endforeach</strong></h6>
                    </div>
                    <div class="col-12" style="background: var(--bs-white);border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;"><img class="img-fluid d-inline" src="{{asset('new-assets/img/barcode%201.png')}}" style="width: 72px;"><img class="img-fluid d-inline" src="{{asset('new-assets/img/barcode%202.png')}}" style="width: 72px;"><img class="img-fluid d-inline" src="{{asset('new-assets/img/barcode%203.png')}}" style="height: 52.3594px;font-size: 8px;">
                        <p style="font-size: 11px;color: rgb(161,162,163);letter-spacing: -1px;">Valid until Tuesday 28th after purchase</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
