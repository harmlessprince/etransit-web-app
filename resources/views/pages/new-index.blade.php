{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">--}}
{{--    <title>{{env('APP_NAME')}}</title>--}}
{{--    <link rel="stylesheet" href="new-assets/bootstrap/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arsenal&amp;display=swap">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap&amp;display=swap">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie&amp;display=swap">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700&amp;display=swap">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;display=swap">--}}
{{--    <link rel="stylesheet" href="new-assets/fonts/fontawesome-all.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/fonts/font-awesome.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/fonts/ionicons.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/fonts/material-icons.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/fonts/typicons.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/fonts/fontawesome5-overrides.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Brands.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/etransit-top-nav.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/etransit-vehicle-slide.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Etransitnews.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Form-Input.css">--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/@bootstrapstudio/bootstrap-better-nav/dist/bootstrap-better-nav.min.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Login-Form-Dark.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/MAV_LanguageSelectButton.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Modern-Contact-Form.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/navbar.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Responsive-Product-Slider.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Search-Input-Responsive-with-Icon.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/styles.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Timeline-Steps.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Tricky-Grid---2-Column-on-Desktop--Tablet-Flip-Order-of-12-Column-rows-on-Mobile.css">--}}
{{--    <link rel="stylesheet" href="new-assets/css/Ultimate-Testimonial-Slider-BS5.css">--}}
{{--</head>--}}

{{--<body>--}}
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
</style>

@section('content')

<section style="height: 400px;background: url(&quot;../new-assets/img/Rectangle%203.png&quot;) center / cover no-repeat;" >
    <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 400px;background: rgba(11,8,8,0.73);">
        <div class="container d-md-flex justify-content-md-center align-items-md-center">
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Our 24 Hour's Services</p>
                    <h1 style="color: var(--bs-white);text-align: center;"><strong>EASY, SAFE AND CONVENIENT</strong></h1>
                    <p style="font-size: 20px;color: var(--bs-white);text-align: center;padding-right: 80px;padding-left: 80px;">Loren ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna lipua&nbsp;&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container menudisplay menu" id="menumenudisplay" style="padding-right: 100px;padding-left: 100px;border-radius: 10px;">
    <div class="row">
        <div class="col" style="box-shadow: 1px 0px 7px rgb(103,103,103);border-radius: 10px;">
            <div class="row divshow" style="background: #ffffff;border-radius: 10px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;border-color: rgba(33,37,41,0);border-bottom: 1px solid rgb(227,228,230);">
                <div class="col-3 col-sm-3 col-xs-3 carhover" id="bus_booking"  onclick="busnav()" style="text-align: center;padding-top: 25px;padding-bottom: 12px;margin: 0px;border-right: 1px solid rgb(219,220,221);border-top-left-radius: 10px;"><img class="img-fluid" src="{{asset('new-assets/img/Layer%201dr.png')}}">
                    <div class="divline"></div>
{{--                    style="border-color: rgb(52,63,95);color: rgb(23,31,72);"--}}
                    <p ><strong>BUS BOOKING</strong></p>
                </div>
                <div class="col-3 col-sm-3 col-xs-3 carhover" id="train_booking" onclick="trainnav()" style="text-align: center;padding-top: 12px;padding-bottom: 12px;border-right: 1px solid rgb(219,220,221) ;"><img class="img-fluid" src="{{asset('new-assets/img/2003.i602.001_railway_station_set_flat-11%20[Converted]%201.svg')}}">
                    <div class="divline"></div>
{{--                    style="color: rgb(23,31,72);"--}}
                    <p ><strong>TRAIN TICKET&nbsp;</strong></p>
                </div>
                <div class="col-3 col-sm-3 col-xs-3 carhover" id="ferry_booking" onclick="cruisenav()" style="text-align: center;padding-top: 25px;padding-bottom: 12px;border-right: 1px solid rgb(219,220,221) ;"><img class="img-fluid" src="{{asset('new-assets/img/10.svg')}}">
                    <div class="divline"></div>
{{--                    style="color: rgb(23,31,72);"--}}
                    <p ><strong>FEERY BOOKING</strong></p>
                </div>
                <div class="col-3 col-sm-3 col-xs-3 carhover" id="flight_booking" onclick="flightnav()" style="text-align: center;padding-top: 25px;padding-bottom: 12px;border-top-right-radius: 10px;"><img class="img-fluid" src="{{asset('new-assets/img/Layer%201.png')}}">
                    <div class="divline"></div>
{{--                    style="color: rgb(23,31,72);"--}}
                    <p ><strong>FLIGHT BOOKING</strong></p>
                </div>
            </div>
            <div class="row divshows" style="background: #ffffff;border-radius: 10px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;border-color: rgba(33,37,41,0);border-bottom: 1px solid rgb(227,228,230);">
                <div class="col-3 col-sm-3 col-xs-3" onclick="busnav()" style="text-align: center;border-right: 1px solid rgb(219,220,221);padding-top: 15px;padding-bottom: 15px;">
                    <a><i class="fa fa-bus" style="font-size: 36px;color: #e16803;"></i></a>
                </div>
                <div class="col-3 col-sm-3 col-xs-3" style="text-align: center;border-right: 1px solid rgb(219,220,221);padding-top: 15px;padding-bottom: 15px;" onclick="trainnav()">
                    <a ><i class="fa fa-train" style="font-size: 36px;color: #e16803;"></i></a>
                </div>
                <div class="col-3 col-sm-3 col-xs-3" onclick="cruisenav()"  style="text-align: center;border-right: 1px solid rgb(219,220,221);padding-top: 15px;padding-bottom: 15px;">
                    <a ><i class="icon ion-android-boat" style="font-size: 36px;color: #e16803;"></i></a>
                </div>
                <div class="col-3 col-sm-3 col-xs-3" style="text-align: center;padding-top: 15px;padding-bottom: 15px;" onclick="flightnav()">
                    <a  ><i class="material-icons" style="font-size: 36px;color: #e16803;">flight</i></a>
                </div>
            </div>
            <div id="bus_form">
                <form method="POST" action="{{url('/bus/bookings')}}">
                    @csrf
                    <div class="row" style="background: #ffffff;padding-top: 20px;padding-bottom: 20px;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                        <div class="col"><button class="" type="button" id="one_way_trip" onclick="oneWayTrip()" style="margin-right: 5px;margin-left: 5px;width: 160px;border-style: none; border-bottom-style: none; padding:10px;">One way</button><button class="getspace" id="return_trip" type="button" onclick="ReturnTrip()" style="margin-right: 5px;margin-left: 5px;width: 160px; border-style: none;border-bottom-style: none; padding:10px;">Round Trip</button></div>
                        <input type="hidden" name="service_id"  value="{{$busService->id}}" />
                        <input type="hidden" name="trip_type" id="trip_type" class="one-way-trip-input" id="trip-form" value="" />
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex" style="background: #ffffff;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                                <div class="col-sm-6 col-md-4" style="padding-top: 10px;">
                                    <label class="form-label" style="font-size: 14px;"><strong>DEPARTURE DATE</strong></label>
                                    <input class="form-control" id="datemob" type="date" name="departure_date"  style="border-style: none;border-right-style: solid;border-radius: 0px;"></div>
                                <div class="col-sm-6 col-md-4" id="return_date_box" style="padding-top: 10px;">
                                    <label class="form-label" style="font-size: 14px;"><strong>RETURN DATE</strong></label>
                                    <input class="form-control" id="datemob2" name="return_date"   type="date" style="border-style: none;border-right-style: solid;border-radius: 0px;"></div>
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
                                    <label class="form-label d-block" style="margin-bottom: 8px;font-size: 14px;"><strong>LOCATION</strong></label>
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
                <form method="POST" action="{{url('/bus/bookings')}}">
                    @csrf
                    <div class="row" style="background: #ffffff;padding-top: 20px;padding-bottom: 20px;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                        <div class="col"><button class="btn btn-primary" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(52,63,95);border-style: none;border-bottom-style: none;">One way</button><button class="btn btn-primary .getspace" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(200,200,200);border-style: none;border-bottom-style: none;">Round Trip</button></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex" style="background: #ffffff;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                                <div class="col-sm-6 col-md-4" style="padding-top: 10px;"><label class="form-label" style="font-size: 14px;"><strong>DEPARTURE DATE</strong></label><input class="form-control" id="datemob" type="date" style="border-style: none;border-right-style: solid;border-radius: 0px;"></div>
                                <div class="col-sm-6 col-md-4 .getspace" style="padding-top: 10px;">
                                    <ul class="list-inline" id="listposition">
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#" style="color: var(--bs-orange);">TODAY</a></li>
                                        <li class="list-inline-item">|</li>
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#" style="color: var(--bs-dark);">TOMORROW</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-md-4 getalign" style="padding-top: 10px;text-align: center;"><label class="form-label" style="font-size: 14px;">NO. OF PERSON</label><select class="form-select" style="text-align: center;border-style: none;border-bottom-style: solid;border-radius: 0px;">
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select></div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-sm-6 col-md-4 createspace"><label class="form-label d-block" style="margin-bottom: 8px;font-size: 14px;"><strong>LOCATION</strong></label><span class="d-block" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING FROM</span><select class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                        <option value="Abia" selected="">Abia</option>
                                    </select></div>
                                <div class="col-sm-6 col-md-4"><span class="d-block" id="spanposition" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING TO</span><select class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                        <option value="Lagos" selected="">Lagos</option>
                                    </select></div>
                                <div class="col-sm-12 col-md-4 d-lg-flex justify-content-lg-center align-items-lg-end" style="text-align: center;padding-right: 5px;padding-left: 4px;"><button class="btn btn-primary" type="submit" style="margin-right: 5px;margin-left: 5px;width: auto;background: rgb(52,63,95);border-style: none;border-bottom-style: none;padding-right: 50px;padding-left: 50px;">PROCEED</button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="ferry_form">
                <form method="POST" action="{{url('/bus/bookings')}}">
                    @csrf
                    <div class="row" style="background: #ffffff;padding-top: 20px;padding-bottom: 20px;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                        <div class="col"><button class="btn btn-primary" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(52,63,95);border-style: none;border-bottom-style: none;">One way</button><button class="btn btn-primary .getspace" type="button" style="margin-right: 5px;margin-left: 5px;width: 160px;background: rgb(200,200,200);border-style: none;border-bottom-style: none;">Round Trip</button></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex" style="background: #ffffff;border-style: none;border-bottom: 1px none rgb(217,218,220) ;">
                                <div class="col-sm-6 col-md-4" style="padding-top: 10px;"><label class="form-label" style="font-size: 14px;"><strong>DEPARTURE DATE</strong></label><input class="form-control" id="datemob" type="date" style="border-style: none;border-right-style: solid;border-radius: 0px;"></div>
                                <div class="col-sm-6 col-md-4 .getspace" style="padding-top: 10px;">
                                    <ul class="list-inline" id="listposition">
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#" style="color: var(--bs-orange);">TODAY</a></li>
                                        <li class="list-inline-item">|</li>
                                        <li class="list-inline-item"><a class="text-decoration-none" href="#" style="color: var(--bs-dark);">TOMORROW</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-md-4 getalign" style="padding-top: 10px;text-align: center;"><label class="form-label" style="font-size: 14px;">NO. OF PERSON</label><select class="form-select" style="text-align: center;border-style: none;border-bottom-style: solid;border-radius: 0px;">
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select></div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-sm-6 col-md-4 createspace"><label class="form-label d-block" style="margin-bottom: 8px;font-size: 14px;"><strong>LOCATION</strong></label><span class="d-block" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING FROM</span><select class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                        <option value="Abia" selected="">Abia</option>
                                    </select></div>
                                <div class="col-sm-6 col-md-4"><span class="d-block" id="spanposition" style="font-size: 9px;color: rgb(146,150,154);">TRAVELING TO</span><select class="form-select" style="border-style: none;border-right-style: solid;border-radius: 0px;">
                                        <option value="Lagos" selected="">Lagos</option>
                                    </select></div>
                                <div class="col-sm-12 col-md-4 d-lg-flex justify-content-lg-center align-items-lg-end" style="text-align: center;padding-right: 5px;padding-left: 4px;"><button class="btn btn-primary" type="submit" style="margin-right: 5px;margin-left: 5px;width: auto;background: rgb(52,63,95);border-style: none;border-bottom-style: none;padding-right: 50px;padding-left: 50px;">PROCEED</button></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<section style="padding-top: 60px;" id="about_us_section">
    <div class="container">
        <div class="row">
            <div class="col" style="padding-top: 12px;padding-bottom: 11px;">
                <h1 style="text-align: center;"><strong>About US</strong></h1>
                <p style="text-align: center;">WELCOME TO E-TRANSIT</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="row">
                    <div class="col-4">
                        <p style="margin-top: 20px;text-align: right;margin-bottom: 1px;padding-right: 24px;font-size: 14px;color: var(--bs-gray-600);">ABOUT</p>
                        <p style="margin-top: 1px;text-align: right;font-size: 14px;color: var(--bs-gray-600);">E-TRANSIT</p>
                        <p style="margin-top: 320px;text-align: right;margin-bottom: 1px;padding-right: 56px;font-size: 14px;"><strong>WHY</strong></p>
                        <p style="margin-top: 1px;text-align: right;font-size: 14px;"><strong>CHOOSE US?</strong></p>
                    </div>
                    <div class="col-8" style="padding-right: 0px;padding-left: 0px;">
                        <ul class="timeline" style="padding-left: 30px;margin-left: 9px;">
                            <li class="tryluck"><a class="text-decoration-none" href="#">
                                    <p class="text-decoration-none" style="font-size: 14px;color: var(--bs-gray-600);">Etransit Africa is an African-focused transpotation service company that exists to provide individuals and cooperate bodies with satisfactory transportation services on a timely and consistent basis</p>
                                </a><a class="text-decoration-none" href="#">
                                    <p class="text-decoration-none" style="color: var(--bs-gray-600);font-size: 14px;">The company stated operations in 2019 as an interstate transport company in Nigeria but projects to provide transportation services accross Africa. Our team of highly&nbsp; trained professionals are always working towards making each travel experience worth every penny&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                                </a></li>
                            <li style="margin-left: 0px;">SAVE MORE<a class="text-decoration-none" href="#">
                                    <p class="text-decoration-none" style="color: var(--bs-gray-600);font-size: 14px;">Get the best affordable rates. Book your trips with us today<span class="d-block" style="font-size: 16px;color: rgb(0,3,6);margin-top: 10px;">RELIABLE</span><span>Don't get stuck with the rest, journey with best.</span><span class="d-block" style="font-size: 16px;color: rgb(0,2,3);margin-top: 10px;">GREAT FEEDBACK</span><span>Your safety and comfort is our numbr one priority</span></p>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-md-flex justify-content-md-center align-items-md-center"><img class="img-fluid d-md-flex" src="new-assets/img/Rectangle%20653.svg"></div>
        </div>
    </div>
</section>
<section class="discounts" style="background: #1f0844;height: 200px;">
    <div class="container" style="height: 200px;padding-right: 0px;padding-left: 0px;margin-right: 0px;margin-left: 197px;">
        <div class="row" style="height: 200px;">
            <div class="col-3" style="height: 200px;"><img src="new-assets/img/favpng_toyota-hiace-car-van-toyota-camry%201.svg" style="margin-left: -196px;margin-top: 20px;"></div>
            <div class="col-3 text-center" style="text-align: center;">
                <p class="text-center" style="margin-top: 8px;"><span class="d-block" style="color: var(--bs-white);font-size: 14px;letter-spacing: 3px;">ENJOY</span><span class="d-block" style="color: var(--bs-white);font-weight: bold;letter-spacing: 2px;">30%</span><span class="d-block" style="color: var(--bs-white);font-weight: bold;letter-spacing: 6px;">DISCOUNT</span><span class="d-block" style="color: var(--bs-white);font-size: 12px;">ON</span><span class="d-block" style="color: var(--bs-white);letter-spacing: 3px;">YOUR</span><span class="d-block" style="color: var(--bs-white);letter-spacing: 2px;">INTERSTATE TRIP<br></span><span class="d-block" style="width: 152px;color: var(--bs-white);text-align: center;"></span><button class="btn btn-primary" type="button" style="height: 31px;padding-top: 2px;margin-top: 8px;background: #f1530f;">GET STARTED</button></p>
            </div>
            <div class="col-6" style="background: url(&quot;new-assets/img/Rectangle%20654%20(1).svg&quot;) no-repeat;background-size: cover;">
                <div class="row" style="background: rgba(31,8,68,0.63);">
                    <div class="col" style="background: rgba(31,8,68,0.3);  z-index:2;"><span id="overwrite" style="font-size: 20px;font-weight: bold;color: var(--bs-white);letter-spacing: 8px;line-height: 15px;"><strong>TRAVEL TIPS</strong></span><span id="overwrites" style="color: var(--bs-white);text-align: center;width: 234px;">Tips from our travel experts to make your trip even better.</span><span id="overwritesbutton"><button class="btn btn-primary" type="button" style="width: 98.5px;height: 34px;padding-top: 3px;font-size: 13px;background: rgba(13,110,253,0);border-color: var(--bs-orange);border-bottom-color: var(--bs-orange);">SIGN UP</button></span></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="margin-top: 114px;">
    <div class="container">
        <div class="row">
            <div class="col" style="text-align: center;">
                <h1 style="color: #1e044a;"><strong>Popular Trips</strong></h1>
                <p>BOOK EXECUTIVE VEHICLES TO MOVE YOU AROUND</p>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col">
                <div class="carousel slide" data-bs-ride="carousel" id="carousel-2">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row product-list">
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="box-shadow: 1px 1px 7px rgb(162,164,167);padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;box-shadow: 1px 1px 7px rgb(162,164,167);">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;box-shadow: 1px 1px 7px rgb(162,164,167);">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="box-shadow: 1px 1px 7px rgb(162,164,167);border-radius: 10px;padding: 10px;padding-top: 5px;padding-bottom: 5px;">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><img class="w-100 d-block d-none" src="http://placeholdit.imgix.net/~text?txtsize=42&amp;txt=Carousel+Image&amp;w=1400&amp;h=600" alt="Slide Image">
                        </div>
                        <div class="carousel-item">
                            <div class="container">
                                <div class="row product-list">
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;box-shadow: 1px 1px 7px rgb(162,164,167);">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-start" style="width: 252px;padding-right: 0px;padding-left: 0px;font-size: 20px;text-align: left;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="box-shadow: 1px 1px 7px rgb(162,164,167);border-radius: 10px;padding: 10px;padding-top: 5px;padding-bottom: 5px;">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;box-shadow: 1px 1px 7px rgb(162,164,167);">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 product-item">
                                        <div class="product-container" style="padding: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 10px;box-shadow: 1px 1px 7px rgb(162,164,167);">
                                            <div class="row">
                                                <div class="col-md-12"><a class="product-image" style="margin-bottom:-10px;" href="#"><img class="rounded img-fluid" style="border: 6px none rgb(220,219,219) ;" src="new-assets/img/PngItem_3891621%201.svg"></a></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="width:252px;padding-right:0px;padding-left:0px;font-size:3px;">
                                                    <h2 class="text-nowrap fw-normal text-start" style="text-align: left;padding-left: 20px;"><a class="fw-normal text-start" style="color: rgb(8,1,1);font-size: 17px;font-family: Abel, sans-serif;margin-left: -2px;" href="#">Luxus RX 360<br></a></h2>
                                                    <p style="color: rgb(25,25,25);font-size: 14px;">&nbsp; &nbsp; &nbsp;&nbsp;<i class="fa fa-question" style="color: rgb(217,135,60);"></i>&nbsp;Auto&nbsp; &nbsp;<i class="la la-automobile" style="color: rgb(217,135,60);"></i>&nbsp;7 Adult&nbsp; &nbsp;&nbsp;<i class="fa fa-asterisk" style="color: rgb(207,115,48);"></i>&nbsp; Fuctional</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><img class="w-100 d-block d-none" src="http://placeholdit.imgix.net/~text?txtsize=42&amp;txt=Carousel+Image&amp;w=1400&amp;h=600" alt="Slide Image">
                        </div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-2" role="button" data-bs-slide="prev" style="background-image:url(&quot;0&quot;);"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-2" role="button" data-bs-slide="next" style="background-image:url(&quot;o&quot;);"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carousel-2" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carousel-2" data-bs-slide-to="1"></li>
                    </ol>
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
@endsection
