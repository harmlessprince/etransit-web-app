@extends('layouts.app')
<style>

    #ferry_form , #train_form{
        display:none;
    }
    /*#one_way_trip{*/
    /*    background: rgb(52,63,95);*/
    /*}*/
    #return_trip{
        background: rgb(200,200,200);
    }
    #return_date_box{
        display:none;
    }
    body{
        width:100%;
    }
    #ferry_return_date{
        display: none;
    }
    a, a:hover, a:focus, a:active {
        text-decoration: none !important;
        color: inherit !important;
    }
    #train_return_date{
        display: none;
    }
    #one_way_train_trip{
        background: #343f5f;
        color:#fff;
        padding:10px;
    }
    #return_train_trip{
        color:#eee;
        padding:10px;

    }


    .mobile-copy{
        display: none;
    }
    }





    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        /*background-color: #fefefe;*/
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

</style>

@section('content')

    <section class="hero" style="height: 400px;background: url(&quot;../new-assets/img/Rectangle%203.png&quot;) center / cover no-repeat; " >
        <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 400px;background: rgba(11,8,8,0.73);">
            <div class="container d-md-flex justify-content-md-center align-items-md-center">
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Your 24/7 one-stop transit and logistics service</p>
                        <h1 style="color: var(--bs-white);text-align: center;"><strong>EASY SAFE CONVENIENT</strong></h1>
                        {{--<p style="font-size: 20px;color: var(--bs-white);text-align: center;padding-right: 80px;padding-left: 80px;" class="mobile-copy">Hire a vehicle,send a parcel, book a bus,flight,boat cruise or ferry instantly at your fingertips. No queues. No delays.&nbsp;&nbsp;</p>
                      --}} </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container menudisplay menu" id="menumenudisplay" style="border-radius: 10px; margin-bottom: 30px;">
        {{--    padding-right: 100px;padding-left: 100px;--}}
        <div class="row">
            <div class="col" style="box-shadow: 1px 0px 7px rgb(103,103,103);border-radius: 10px;">
                <div class="row divshow" style="background: #ffffff;border-radius: 10px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;border-color: rgba(33,37,41,0);border-bottom: 1px solid rgb(227,228,230);">
                    <div class="col-3 col-sm-3 col-xs-3 carhover" id="flight_booking"  style="text-align: center;padding-top: 25px;padding-bottom: 12px;border-top-right-radius: 10px;">
                        <a href="{{url('car-hire')}}" target="_blank">
                            <img class="img-fluid" src="{{asset('new-assets\img\car-hire\car_menu_icon.png')}}">
                            <div class="divline"></div>
                            <p ><strong>VEHICLE HIRE</strong></p>
                        </a>

                    </div>
                    <div class="col-3 col-sm-3 col-xs-3 carhover" id="bus_booking"  onclick="busnav()" style="text-align: center;padding-top: 25px;padding-bottom: 12px;margin: 0px;border-right: 1px solid rgb(219,220,221);border-top-left-radius: 10px;">
                        <img class="img-fluid" src="{{asset('new-assets/img/Layer%201dr.png')}}">
                        <div class="divline"></div>
                        <p ><strong>BUS BOOKING</strong></p>
                    </div>
                    <div class="col-3 col-sm-3 col-xs-3 carhover" id="train_booking" onclick="trainnav()" style="text-align: center;padding-top: 12px;padding-bottom: 12px;border-right: 1px solid rgb(219,220,221) ;">
                        <img class="img-fluid" src="{{asset('new-assets/img/2003.i602.001_railway_station_set_flat-11%20[Converted]%201.svg')}}">
                        <div class="divline"></div>
                        <p ><strong>TRAIN TICKET&nbsp;</strong></p>
                    </div>
                    {{--<div class="col-3 col-sm-3 col-xs-3 carhover" id="ferry_booking" onclick="cruisenav()" style="text-align: center;padding-top: 25px;padding-bottom: 12px;border-right: 1px solid rgb(219,220,221) ;">
                        <img class="img-fluid" src="{{asset('new-assets/img/10.svg')}}">
                        <div class="divline"></div>
                        <p ><strong>FERRY BOOKING</strong></p>
                    </div> --}}
                    <div class="col-3 col-sm-3 col-xs-3 carhover" id="flight_booking"  style="text-align: center;padding-top: 25px;padding-bottom: 12px;border-top-right-radius: 10px;">
                        <a href="https://www.travelstart.com.ng/?affId=218470&utm_source=affiliate&utm_medium=218470" target="_blank">
                            <img class="img-fluid" src="{{asset('new-assets/img/Layer%201.png')}}">
                            <div class="divline"></div>
                            <p ><strong>FLIGHT BOOKING</strong></p>
                        </a>

                    </div>
                </div>
                <div class="row divshows" style="background: #ffffff;border-radius: 10px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;border-color: rgba(33,37,41,0);border-bottom: 1px solid rgb(227,228,230);">
                    <div class="col-3 col-sm-3 col-xs-3" style="text-align: center;padding-top: 15px;padding-bottom: 15px;" >
                        <a href="{{url('car-hire')}}" target="_blank">
                            <i class="fa fa-car" style="font-size: 36px;color: #e16803;"></i>
                        </a>
                    </div>
                    <div class="col-3 col-sm-3 col-xs-3" onclick="busnav()" style="text-align: center;border-right: 1px solid rgb(219,220,221);padding-top: 15px;padding-bottom: 15px;">
                        <a><i class="fa fa-bus" style="font-size: 36px;color: #e16803;"></i></a>
                    </div>
                    <div class="col-3 col-sm-3 col-xs-3" style="text-align: center;border-right: 1px solid rgb(219,220,221);padding-top: 15px;padding-bottom: 15px;" onclick="trainnav()">
                        <a ><i class="fa fa-train" style="font-size: 36px;color: #e16803;"></i></a>
                    </div>
                    <!--
                    <div class="col-3 col-sm-3 col-xs-3" onclick="cruisenav()"  style="text-align: center;border-right: 1px solid rgb(219,220,221);padding-top: 15px;padding-bottom: 15px;">
                        <a ><i class="icon ion-android-boat" style="font-size: 36px;color: #e16803;"></i></a>
                    </div> -->
                    <div class="col-3 col-sm-3 col-xs-3" style="text-align: center;padding-top: 15px;padding-bottom: 15px;" >
                        <a href="https://www.travelstart.com.ng/?affId=218470&utm_source=affiliate&utm_medium=218470" target="_blank">
                            <i class="material-icons" style="font-size: 36px;color: #e16803;">flight</i>
                        </a>
                    </div>
                </div>
                <div id="bus_form">
                    <form method="POST" action="{{url('/bus/bookings')}}">
                        @csrf
                        <div class="row" style="background: #ffffff;padding-top: 20px;padding-bottom: 20px;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                            <div class="col">
                                <button class="" type="button" id="one_way_trip" onclick="oneWayTrip()" style="margin-right: 5px;margin-left: 5px;width: 160px;border-style: none; border-bottom-style: none; padding:10px;">One way</button>
                                <button class="getspace" id="return_trip" type="button" onclick="ReturnTrip()" style="margin-right: 5px;margin-left: 5px;width: 160px; border-style: none;border-bottom-style: none; padding:10px;">Round Trip</button>
                            </div>
                            <input type="hidden" name="service_id"  value="{{$busService->id}}" />
                            <input type="hidden" name="trip_type" id="trip_type" class="one-way-trip-input" id="trip-form" value="" />
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row d-flex" style="background: #ffffff;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                                    <div class="col-sm-6 col-md-4" style="padding-top: 10px;">
                                        <label class="form-label" style="font-size: 14px;"><strong>DEPARTURE DATE</strong></label>
                                        <input class="form-control" id="datemob" type="date" name="departure_date" min="{{ date('Y-m-d') }}" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                    </div>
                                    <div class="col-sm-6 col-md-4" id="return_date_box" style="padding-top: 10px;">
                                        <label class="form-label" style="font-size: 14px;"><strong>RETURN DATE</strong></label>
                                        <input class="form-control" id="datemob2" name="return_date"   type="date" min="{{ date('Y-m-d') }}" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                    </div>
                                    <div class="col-sm-6 col-md-4 getalign" style="padding-top: 10px;text-align: center;">
                                        <label class="form-label" style="font-size: 14px;">NO. OF PERSON</label>
                                        <select class="form-select" style="text-align: center;border-style: none;border-bottom-style: solid;border-radius: 0px;" name="number_of_passengers" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select></div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-sm-6 col-md-4 createspace">
                                        <label class="form-label d-block" style="margin-bottom: 8px;font-size: 14px;">
                                            <strong>LOCATION</strong>
                                        </label>
                                        <span class="d-block" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING FROM</span>
                                        <select class="form-select" name="destination_from"  style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}" selected="">{{$location->location}}</option>
                                            @endforeach
                                        </select></div>
                                    <div class="col-sm-6 col-md-4">
                                        <span class="d-block" id="spanposition" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING TO</span>
                                        <select name="destination_to"  class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}" selected="">{{$location->location}}</option>
                                            @endforeach
                                        </select></div>
                                    <div class="col-sm-12 col-md-4 d-lg-flex justify-content-lg-center align-items-lg-end" style="text-align: center;padding-right: 5px;padding-left: 4px;"><button class="btn btn-primary" type="submit" style="margin-right: 5px;margin-left: 5px;width: auto;background: rgb(52,63,95);border-style: none;border-bottom-style: none;padding-right: 50px;padding-left: 50px;">PROCEED</button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="train_form">
                    <form method="POST" action="{{url('/train/bookings')}}">
                        @csrf
                        <input type="hidden" name="tripType" id="train_trip_type"  value="" />
                        <div class="row" style="background: #ffffff;padding-top: 20px;padding-bottom: 20px;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                            <div class="col">

                                <button class="" type="button" id="one_way_train_trip" style="margin-right: 5px;margin-left: 5px;width: 160px;border-style: none;" onclick="oneWayTrainTrip()">One way</button>
                                <button class="" id="return_train_trip" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(200,200,200);border-style: none;border-bottom-style: none;" onclick="ReturnTrainTrip()">Round Trip</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row d-flex" style="background: #ffffff;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                                    <div class="col-sm-6 col-md-4" style="padding-top: 10px;">
                                        <label class="form-label" style="font-size: 14px;">
                                            <strong>DEPARTURE DATE</strong>
                                        </label>
                                        <input class="form-control" id="datemob" name="departure_date" type="date" min="{{ date('Y-m-d') }}" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                    </div>
                                    <div class="col-sm-6 col-md-4" style="padding-top: 10px;">
                                        <label class="form-label" style="font-size: 14px;">
                                            <strong>RETURN DATE</strong>
                                        </label>
                                        <input class="form-control" id="train_return_date" name="return_date"  type="date" min="{{ date('Y-m-d') }}" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                    </div>
                                    <div class="col-sm-4 col-md-4 getalign" style="padding-top: 10px;text-align: center;">
                                        <label class="form-label" style="font-size: 14px;">NO. OF PERSON</label>
                                        <select class="form-select" style="text-align: center;border-style: none;border-bottom-style: solid;border-radius: 0px;" name="passenger">
                                            <option value="1" selected="">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select></div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-sm-6 col-md-4 createspace"><label class="form-label d-block" style="margin-bottom: 8px;font-size: 14px;">
                                            <strong>LOCATION</strong></label>
                                        <span class="d-block" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING FROM</span>
                                        <select class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;" name="destination_from">
                                            @foreach($train_locations as $train_location)
                                                <option value="{{$train_location->id}}" selected="">{{$train_location->locations_state}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <span class="d-block" id="spanposition" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING TO</span>
                                        <select class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;" name="destination_to">
                                            @foreach($train_locations as $train_location)
                                                <option value="{{$train_location->id}}" selected="">{{$train_location->locations_state}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-lg-flex justify-content-lg-center align-items-lg-end" style="text-align: center;padding-right: 5px;padding-left: 4px;"><button class="btn btn-primary" type="submit" style="margin-right: 5px;margin-left: 5px;width: auto;background: rgb(52,63,95);border-style: none;border-bottom-style: none;padding-right: 50px;padding-left: 50px;">PROCEED</button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="ferry_form">
                    <form method="POST" action="{{url('/ferry/bookings')}}">
                        @csrf
                        <div class="row" style="background: #ffffff;padding-top: 20px;padding-bottom: 20px;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                            <div class="col">
                                {{--                            <button class="btn btn-primary" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(52,63,95);border-style: none;border-bottom-style: none;">One way</button>--}}
                                {{--                            <button class="btn btn-primary .getspace" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(200,200,200);border-style: none;border-bottom-style: none;">Round Trip</button>--}}
                                <div class="col">
                                    <button class="" type="button" id="one_way_ferry_trip" onclick="oneWayFerryTrip()" style="margin-right: 5px;margin-left: 5px;width: 160px;border-style: none; border-bottom-style: none; padding:10px;">One way</button>
                                    <button class="getspace" id="return_ferry_trip" type="button" onclick="ReturnFerryTrip()" style="margin-right: 5px;margin-left: 5px;width: 160px; border-style: none;border-bottom-style: none; padding:10px;">Round Trip</button>
                                </div>
                                <input type="hidden" name="service_id"  value="{{$FerryService->id}}" />
                                <input type="hidden" name="ferry_trip_type_id" id="ferry_trip_type" class="one-way-trip-input"  value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row d-flex" style="background: #ffffff;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                                    <div class="col-sm-3 col-md-3" style="padding-top: 10px;">
                                        <label class="form-label" style="font-size: 14px;">
                                            <strong>DEPARTURE DATE</strong>
                                        </label>
                                        <input class="form-control" id="datemob" name="departure_date" type="date" min="{{ date('Y-m-d') }}" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                    </div>
                                    <div class="col-sm-3 col-md-3" style="padding-top: 10px;" id="ferry_return_date">
                                        <label class="form-label" style="font-size: 14px;">
                                            <strong>RETURN DATE</strong>
                                        </label>
                                        <input class="form-control" id="datemob" name="return_date" type="date" min="{{ date('Y-m-d') }}" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                    </div>

                                    <div class="col-sm-3 col-md-3 getalign" style="padding-top: 10px;text-align: center;">
                                        <label class="form-label" style="font-size: 14px;">NO. OF PERSON</label>
                                        <select class="form-select" name="number_of_passengers" style="text-align: center;border-style: none;border-bottom-style: solid;border-radius: 0px;">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-3 getalign" style="padding-top: 10px;text-align: center;"><label class="form-label" style="font-size: 14px;">Ferry Types</label>
                                        <select class="form-select" name="ferry_type" style="text-align: center;border-style: none;border-bottom-style: solid;border-radius: 0px;">
                                            @foreach($ferryTypes  as $type)
                                                <option value="{{$type->id}}">{{Ucfirst($type->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-sm-6 col-md-4 createspace"><label class="form-label d-block" style="margin-bottom: 8px;font-size: 14px;">
                                            <strong>LOCATION</strong></label><span class="d-block" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING FROM</span>
                                        <select class="form-select" name="destination_from" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                            @foreach($ferryLocations as $floc)
                                                <option value="{{$floc->id}}">{{$floc->locations}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <span class="d-block" id="spanposition" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING TO</span>
                                        <select class="form-select" name="destination_to" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                            @foreach($ferryLocations as $floc)
                                                <option value="{{$floc->id}}">{{$floc->locations}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-lg-flex justify-content-lg-center align-items-lg-end" style="text-align: center;padding-right: 5px;padding-left: 4px;">
                                        <button class="btn btn-primary" type="submit" style="margin-right: 5px;margin-left: 5px;width: auto;background: rgb(52,63,95);border-style: none;border-bottom-style: none;padding-right: 50px;padding-left: 50px;">PROCEED</button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <section id="vehicle_hire_cta" style="padding-top: 60px; background-color: #e16803;">
        <div class="container-fluid">
            <div class="row" >
                <div class="col relative h-64 sm:h-80 lg:h-full lg:order-last ">
                    <img class=" inset-0 object-cover w-full h-full" src="{{asset("new-assets/img/car-hire/car-hire-show.png")}}"
                         alt="Vehicle for hire. Illustrative purposes only." />
                </div>
                <div class="col p-lg-5 p-4">
                    <h2 class="fs-2 font-weight-bold fs-sm-1 text-white">Move in style with <em>Premium</em> vehicles</h2>

                    <p class="mt-4 text-gray-600 text-white">
                        Hire a vehicle that matches your style anywhere you are. Our executive-grade SUV's and car are available at your fingertips.
                        <br>

                    </p>
                    <p class="mb-4">
                        <span class="fs-6"><i class="fas fa-user" style="color: #1f0844"></i> Chaffeur included<small>*</small></span>
                        <br>
                        <span class="fs-6" ><i class="fas fa-gas-pump" style="color: #1f0844"></i> Complimentary full tank<small>*</small></span>
                    </p>
                    <a class="inline-flex items-center p-4 py-3 mt-8 text-white  rounded" style="background-color: #1f0844"
                       href="{{url('car-hire')}}">
                        <span class="text-sm font-medium"> Hire Now </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <main>
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row no-gutters">
                    <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-right">
                        <div class="content">
                            <h3>What is Etransit?</h3>
                            <p>
                                Etransit Africa is a technology-focused transportation and related services company providing individuals
                                and corporate bodies with seamless and reliable luxury as well as day to day transport services powered by innovative technology.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-left">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Save More</h4>
                                    <p>Enjoy value for your money. We have the best prices across transit, flights and vehicle hire bookings.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Reliable</h4>
                                    <p>Say goodbye to delays and cancellations.
                                        With real-time tech-enabled monitoring and thousands of vehicles and routes at our diposal, we'll never leave you stranded.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <i class="bx bx-images"></i>
                                    <h4>Seamless</h4>
                                    <p>Hire Vehicles,book bus,train or flight tickets, boat cruises and more with a few clicks via our web and mobile apps.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                    <i class="bx bx-shield"></i>
                                    <h4>Safe and Secure</h4>
                                    <p>Our state of the art trip monitoring and tracking keep you safe when you use any of our services.</p>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Clients Section =======
  <section id="clients" class="clients">
    <div class="container" data-aos="zoom-in">

      <div class="row">

        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
          <img src="{{asset('new-assets/img/client1%201.svg')}}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
          <img src="{{asset('new-assets/img/client2%201.svg')}}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
          <img src="{{asset('new-assets/img/client3%201.svg')}}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
          <img src="{{asset('new-assets/img/client4%201.svg')}}" class="img-fluid" alt="">
        </div>

      </div>

    </div>
  </section>End Clients Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features container" data-aos="fade-up">
            <div class="container">
                <div class="row content">
                    <div class="col-md-5" data-aos="fade-right" data-aos-delay="100">
                        <img src="new-assets\img\assorted-vehicles.png" class="img-fluid h-100" alt="">
                    </div>
                    <div class="col-md-7 pt-4 feature" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="feature-header">Your Reliable, Convenient Choice</h3>
                        <p class="fst-italic feature-description">
                            Access top notch transportation services with ease from the comfort your computer or mobile. Our excellent services such as vehicle hire, bus booking, flight booking, private jets, security
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> More than 500 hubs and 3000 routes covered by our bus network</li>
                            <li><i class="bi bi-check-circle-fill"></i> Over 300 vehicles available for hire </li>
                            <li><i class="bi bi-check-circle-fill"></i> Train, Ferry Booking, Boat cruises, Flights and Private Jets also available.</li>
                        </ul>
                    </div>
                </div>
                <!--
                <div class="row content">
                  <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
                    <img src="assets/img/features-4.png" class="img-fluid" alt="">
                  </div>
                  <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
                    <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
                    <p class="fst-italic">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                      magna aliqua.
                    </p>
                    <p>
                      Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                      velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                      culpa qui officia deserunt mollit anim id est laborum
                    </p>
                  </div>
                </div>
                  -->

            </div>
            <div class="container-fluid alternate-row">
                <div class="row content">
                    <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
                        <img src={{asset("new-assets\img\drivers.jpg")}} class="img-responsive" alt="">
                    </div>
                    <div class="col-md-7 pt-5 order-2 order-md-1 feature" data-aos="fade-right">
                        <h3 class="feature-header">Just Need A Driver for Your Car?</h3>
                        <p class="feature-description fst-italic">
                            With a few taps one of our professional-trained drivers could be at your doorstep.
                        </p>
                        <p>
                            We conduct extensive verification, background checks, screening and training to make sure our drivers are fit for the role.
                            Drivers can be hired hourly, daily, monthly or on special long term arrangements.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row content">
                    <div class="col-md-5" data-aos="fade-right">
                        <img src="new-assets\img\safety icon.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 pt-5 feature" data-aos="fade-left">
                        <h3 class="feature-header">Your Safety. Our Priority.</h3>
                        <p class="feature-description"> We go to great lengths to ensure our services are safe and secure. Our monitoring team is alert to any unforeseen circumstances and will contact the authorities at the siightest hint of concern. We deploy state-of-the art technology to guarantee you safety.</p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> Share your location and trip progress with a trusted contact via our mobile apps.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Active monitoring by our safety team.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Travel insurance is standard on all services </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section><!-- End Features Section -->

        <!-- ======= Services Section =======
        <section id="services" class="services">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Services</h2>
              <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">
              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box">
                  <div class="icon"><i class="bx bxl-dribbble"></i></div>
                  <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                  <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <div class="icon"><i class="bx bx-file"></i></div>
                  <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                  <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <div class="icon"><i class="bx bx-tachometer"></i></div>
                  <h4 class="title"><a href="">Magni Dolores</a></h4>
                  <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                </div>
              </div>

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <div class="icon"><i class="bx bx-layer"></i></div>
                  <h4 class="title"><a href="">Nemo Enim</a></h4>
                  <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                </div>
              </div>

            </div>

          </div>
        </section> End Services Section -->
        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                </div>

                <ul class="faq-list">

                    <li>
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">How do i get my tickets after booking a bus , train or ferry?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                You will receive a booking confirmation email containing your booking details i.e your booking reference number, seat number, vehicle plate number and fare price after completing a successful booking.A payment receipt will also be sent separately if you choose to pay online.
                                You are to present your booking reference number at the departure terminal to receive your ticket(s) and be ushered to your seat. If you chose to pay later you are required to pay your fare at this point.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">At what time should i arrive at my departure terminal for a bus, train or ferry trip?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                You are expected to arrive at the departure terminal at least forty-five (45) minutes before the stated departure time.</p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Who pays for fueling a rented vehicle? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                We will provide you with a full tank when you receive your vehicle. Subsequent fuelling expenses will be covered by you?
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Can I take a vehicle out of state?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Yes you can, please note different rates apply depending on journey length. You will also need to provide suitable accommodation for your driver for overnight journeys.
                            </p>
                        </div>
                    </li>
                </ul>
                <a href="#" class="about-btn">Find Out More <i class="bx bx-chevron-right"></i></a>
            </div>
        </section><!-- End Frequently Asked Questions Section -->


    </main>
    <!--<section class="discounts" style="background: #1f0844;height: 200px;">
    <div class="container" style="height: 200px;padding-right: 0px;padding-left: 0px;margin-right: 0px;margin-left: 197px;">
        <div class="row" style="height: 200px;">
            <div class="col-3" style="height: 200px;">
                <img src="{{asset('new-assets/img/favpng_toyota-hiace-car-van-toyota-camry%201.svg')}}" style="margin-left: -196px;margin-top: 20px;">
            </div>
            <div class="col-3 text-center" style="text-align: center;">
                <p class="text-center" style="margin-top: 8px;"><span class="d-block" style="color: var(--bs-white);font-size: 14px;letter-spacing: 3px;">ENJOY</span><span class="d-block" style="color: var(--bs-white);font-weight: bold;letter-spacing: 2px;">30%</span><span class="d-block" style="color: var(--bs-white);font-weight: bold;letter-spacing: 6px;">DISCOUNT</span><span class="d-block" style="color: var(--bs-white);font-size: 12px;">ON</span><span class="d-block" style="color: var(--bs-white);letter-spacing: 3px;">YOUR</span><span class="d-block" style="color: var(--bs-white);letter-spacing: 2px;">INTERSTATE TRIP<br></span><span class="d-block" style="width: 152px;color: var(--bs-white);text-align: center;"></span><a href="{{route('register')}}" class="btn btn-primary"  style="height: 31px;padding-top: 2px;margin-top: 8px;background: #f1530f; color:white !important;">GET STARTED</a></p>
            </div>
            <div class="col-6" style="background: url(&quot;new-assets/img/Rectangle%20654%20(1).svg&quot;) no-repeat;background-size: cover;">
                <div class="row" style="background: rgba(31,8,68,0.63);">
                    <div class="col" style="background: rgba(31,8,68,0.3);  z-index:2;"><span id="overwrite" style="font-size: 20px;font-weight: bold;color: var(--bs-white);letter-spacing: 8px;line-height: 15px;"><strong>TRAVEL TIPS</strong></span><span id="overwrites" style="color: var(--bs-white);text-align: center;width: 234px;">Tips from our travel experts to make your trip even better.</span><span id="overwritesbutton"><a class="btn btn-primary" href="{{route('register')}}" style="width: 98.5px;height: 34px;padding-top: 3px;font-size: 13px;background: rgba(13,110,253,0);border-color: var(--bs-orange);border-bottom-color: var(--bs-orange); color:white !important;">SIGN UP</a></span></div>
                </div>
            </div>
        </div>
    </div>
</section> -->>
    <section style="margin-top: 114px;">
        <div class="container">
            <div class="row">
                <div class="col" style="text-align: center;">
                    <h1 style="color: #1e044a;"><strong>Hundreds Of Vehicles Available</strong></h1>
                    <p>BOOK EXECUTIVE VEHICLES TO MOVE YOU AROUND</p>
                </div>
            </div>


            <div class="row" style="margin-top: 30px;">
{{--                <div class="col">--}}
{{--                    <div class="carousel slide" data-bs-ride="carousel" id="carousel-2">--}}
{{--                        <div class="carousel-inner">--}}
{{--                            <div class="carousel-item active">--}}
{{--                                <div class="container">--}}
{{--                                    <div class="row product-list">--}}

{{--                                    </div>--}}

{{--                                </div><img class="w-100 d-block d-none" src="https://placeholdit.imgix.net/~text?txtsize=42&amp;txt=Carousel+Image&amp;w=1400&amp;h=600" alt="Slide Image">--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <div class="container">--}}
{{--                                    <div class="row product-list">--}}

{{--                                        @foreach($cars_selection2 as $index  => $car)--}}

{{--                                            <div class="col-sm-3 col-md-3 col-lg-3 product-item">--}}
{{--                                                <div class="product-container" style="padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;box-shadow: 1px 1px 7px rgb(162,164,167);">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-12">--}}
{{--                                                            <a class="product-image" style="margin-bottom:-10px;" href="{{'view-car-details/'. $car->id}}">--}}
{{--                                                                <img class="rounded img-fluid"--}}
{{--                                                                     style="border: 6px none rgb(220,219,219) ;" src="{{$car->car_images[0]->path}}"></a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-start" style="width: 252px;padding-right: 0px;padding-left: 0px;font-size: 20px;text-align: left;">--}}
{{--                                                            <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;">--}}
{{--                                                                <a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">{{$car->car_name}}<br></a></h2>--}}
{{--                                                            <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;--}}
{{--                                                            <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;{{Ucfirst($car->transmission)}} &nbsp;--}}
{{--                                                                <i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;{{$car->capacity}} Adult--}}
{{--                                                                <i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp;--}}
{{--                                                                Functional--}}
{{--                                                            </p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <img class="w-100 d-block d-none" src="https://placeholdit.imgix.net/~text?txtsize=42&amp;txt=Carousel+Image&amp;w=1400&amp;h=600" alt="Slide Image">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div><a class="carousel-control-prev" href="#carousel-2" role="button" data-bs-slide="prev"--}}
{{--                                style="background-image:url(&quot;0&quot;);"><span class="carousel-control-prev-icon"></span><span--}}
{{--                                    class="visually-hidden">Previous</span></a>--}}
{{--                            <a class="carousel-control-next" href="#carousel-2" role="button" data-bs-slide="next"--}}
{{--                               style="background-image:url(&quot;o&quot;);"><span class="carousel-control-next-icon"></span><span--}}
{{--                                    class="visually-hidden">Next</span></a>--}}
{{--                        </div><ol class="carousel-indicators">--}}
{{--                            <li data-bs-target="#carousel-2" data-bs-slide-to="0" class="active"></li>--}}
{{--                            <li data-bs-target="#carousel-2" data-bs-slide-to="1"></li>--}}
{{--                        </ol>--}}
{{--                    </div>--}}
{{--                </div>--}}
                {{--            <div class="container">--}}


                {{--                </div>--}}

                {{--            </div>--}}
                                <div class="row product-list">
                <div class="multiple-items" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                    @foreach($cars as $index  => $car)
                        <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                            <div class="product-container" style="box-shadow: 1px 1px 7px rgb(162,164,167);padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="product-image" style="margin-bottom:-10px;" href="{{'view-car-details/'. $car->id}}">
                                            <img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;"
                                                 src="{{$car->car_images[0]->path}}">
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                        <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;">
                                            <a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">{{$car->car_name}}<br></a></h2>
                                        <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;{{Ucfirst($car->transmission)}} &nbsp;
                                            <i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;{{$car->capacity}} Adult&nbsp;
                                            <i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="news-slider" class="owl-carousel">
                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="https://images.unsplash.com/photo-1596265371388-43edbaadab94?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=301&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=501" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="#">Lorem ipsum dolor sit amet.</a>
                                    </h3>
                                    <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......</p>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span>
                                    <a href="#" class="read-more">read more</a>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="https://images.unsplash.com/photo-1533227268428-f9ed0900fb3b?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=303&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=503" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="#">Lorem ipsum dolor sit amet.</a>
                                    </h3>
                                    <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......</p>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span>
                                    <a href="#" class="read-more">read more</a>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="https://images.unsplash.com/photo-1564979268369-42032c5ca998?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=300&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=500" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="#">Lorem ipsum dolor sit amet.</a>
                                    </h3>
                                    <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......</p>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span>
                                    <a href="#" class="read-more">read more</a>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="https://images.unsplash.com/photo-1576659531892-0f4991fca82b?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=301&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=501" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="#">Lorem ipsum dolor sit amet.</a>
                                    </h3>
                                    <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......</p>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span>
                                    <a href="#" class="read-more">read more</a>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="https://images.unsplash.com/photo-1586083702768-190ae093d34d?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=305&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=505" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="#">Lorem ipsum dolor sit amet.</a>
                                    </h3>
                                    <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......</p>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span>
                                    <a href="#" class="read-more">read more</a>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="https://images.unsplash.com/photo-1484656551321-a1161420a2a0?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=306&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=506" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="#">Lorem ipsum dolor sit amet.</a>
                                    </h3>
                                    <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam consectetur cumque dolorum, ex incidunt ipsa laudantium necessitatibus neque quae tempora......</p>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span>
                                    <a href="#" class="read-more">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col" style="text-align: center;">
                    <h6 style="margin-top: 40px;margin-bottom: 40px;">SOME HAPPY CLIENTS</h6>
                </div>
            </div>
            <div class="row" style="padding-right: 60px;padding-left: 60px;">
                <div class="col" style="text-align: center;"><img class="img-fluid" src="{{asset('new-assets/img/client1%201.svg')}}"></div>
                <div class="col" style="text-align: center;"><img class="img-fluid" src="{{asset('new-assets/img/client2%201.png')}}"></div>
                <div class="col" style="text-align: center;"><img class="img-fluid" src="{{asset('new-assets/img/client3%201.svg')}}"></div>
                <div class="col" style="text-align: center;"><img class="img-fluid" src="{{asset('new-assets/img/client4%201.svg')}}"></div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.multiple-items').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });


    </script>


    <script>

        let counter = 0;
        var modal = document.getElementById("myModal");

        var span = document.getElementsByClassName("close")[0];

        addEventListener('load', (event) => {
            setInterval(function() {
                counter++;
                (counter < 3) ? modal.style.display = "block" : modal.style.display = "none";
            }, 10000);
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        closeModal = () =>
        {
            span.onclick = function() {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        let doc, htm, bod, nav, M, I, mobile, S, Q;
        addEventListener('load', ()=>{
            doc = document; htm = doc.documentElement; bod = doc.body; nav = navigator; M = tag=>doc.createElement(tag); I = id=>doc.getElementById(id);
            mobile = nav.userAgent.match(/Mobi/i) ? true : false;
            S = (selector, within)=>{
                var w = within || doc;
                return w.querySelector(selector);
            }
            Q = (selector, within)=>{
                var w = within || doc;
                return w.querySelectorAll(selector);
            }
// tiny library above - magic below
            const date = I('datemob'), minDate = new Date('{{ date('Y-m-d') }}'), millisecondOverMaxDate = new Date('4/1/2030');
            const date2 = I('datemob2');
            date.onchange = function(){
                const a = this.value.split('-'), s = a.shift(), d = new Date(a.join('/')+'/'+s), t = d.getTime(), y = d.getFullYear();
                console.clear(); // remove consoles on deployment
                if(t >= minDate && t < millisecondOverMaxDate){
                    console.log('within range');
                }
                else{
                    console.log('out of range');
                    this.value = '';
                }
            }

            date2.onchange = function(){
                const a = this.value.split('-'), s = a.shift(), d = new Date(a.join('/')+'/'+s), t = d.getTime(), y = ;
                console.clear(); // remove consoles on deployment
                if(t >= minDate && t < millisecondOverMaxDate){
                    console.log('within range');
                }
                else{
                    console.log('out of range');
                    this.value = '';
                }
            }
        }); // end load
    </script>
    <script>

    </script>
@endsection
