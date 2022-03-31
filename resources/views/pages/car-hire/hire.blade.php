@extends('layouts.app')
<style>
    .booking_text span {
        margin-left: -158px !important;
    }
    .car_hire_container{
        display:grid;
        grid-template-columns: repeat(12, 1fr);
        grid-column-gap: 10px;
    }
    .car_hire_filter_box{
        grid-column: 1/4;
        background:#fff;
        box-shadow: 5px 10px  rgba(219, 226, 241, 0.54);
        position:absolute;
        margin-top:-35px;
        margin-left:100px;
        width:350px;
        padding-top:20px;


    }
    .filter_header{
        display:grid;
        grid-template-columns: repeat(5, 1fr);

    }
.filter_text{
    grid-column: 1/4;
}
.clear_text{
    grid-column: 4/5;
    justify-self:end;

}
    .booking_nav_content{
        position:relative;
    }
    .cars_hire_body_box{
        display:grid;
        grid-template-columns: repeat(12 , 1fr);
        margin-top: 20px;
    }
    .cars_hire_body_box   .car_list{
        grid-column: 6/12;
        background:#FFFFFF;
        padding:10px;
        margin:10px 0 10px 0;
        box-shadow: 5px 5px 5px 5px rgba(209, 209, 209, 0.38);
        border-radius:10px;
    }
    .car_name_function_box .car_name{
        color:black;
    }
    .car_list_content{
        display:grid;
        grid-template-columns: repeat(12 , 1fr);
        /*grid-column-gap: 10px;*/

    }
      .car_img{
        grid-column: 1/2;
        margin-top: 40px;
    }
     .car_name_function_box{
        grid-column: 3/8;
    }
     .car_functionality{
         display:grid;
         grid-template-columns: 1fr 1fr;
     }
    .car_booking_button{
        grid-column: 9/12;

    }
    .car_booking_button  button{
         background: #03174C;
         color: #fff;
         padding:5px;
         border: 1px solid #03174C;
         margin-top: 170px;
         cursor:pointer;
     }
    .car_booking_button  button:hover{
        background: #DC6513;
        color: #fff;
        padding:5px;
        border: 1px solid #DC6513;
        cursor:pointer
    }
    .booking_hero_text{
        display:grid;
        grid-template-columns: repeat(3 , 1fr);
    }
    .booking_hero_icon{
        margin-top:20px;
    }
    .empty_img_box{
        display:flex;
        justify-content: center;
    }
    .my-active span{
        background-color: #021037 !important;
        color: white !important;
        border-color: #021037 !important;
    }
    .pagination_box{
        display:flex;
        justify-content: flex-end;
        margin-top:40px;
        margin-right:150px;
    }
    .car_img{
        width: 240px;
        height: 100px;
    }
    .car_img img{
        width:100%;
    }

    .center_not_found_data{
        display:flex;


    }
</style>
@push('css')

@endpush

@section('content')
{{--    <div class="bookings_box">--}}
{{--        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/booking_hero.png')}}'); height:200px;" >--}}
{{--            <div class="booking_hero_text">--}}
{{--                <div class="booking_hero_icon">--}}
{{--                    <a href="{{url('/')}}">--}}
{{--                     <img src="{{asset('/images/icons/arrow_left_2.png')}}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="booking_text">--}}
{{--                    <h1>Car Hire</h1>--}}
{{--                    <span>Lorem ipsum text here  Lorem ipsum text here Lorem ipsum text here</span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="booking_nav_box">--}}
{{--            <div class="booking_nav_content">--}}
{{--                <div class="booking_nav_item">--}}
{{--                    <div class="booking_nav_destination_from nav_item_bookings">--}}
{{--                        <div class="">--}}
{{--                            <span>From</span>--}}
{{--                        </div>--}}
{{--                        <div class="bookings_nav_text">--}}
{{--                            <span>{{$pickUp->location}}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="booking_nav_destination_to nav_item_bookings">--}}
{{--                        <div class="">--}}
{{--                            <span>To</span>--}}
{{--                        </div>--}}
{{--                        <div class="bookings_nav_text">--}}
{{--                            <span>{{$destination->location}}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="booking_nav_departure_date nav_item_bookings">--}}
{{--                        <div class="">--}}
{{--                            <span>Departure</span>--}}
{{--                        </div>--}}
{{--                        <div class="bookings_nav_text">--}}
{{--                            <span>{{$data['departure_date']}}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="booking_nav_return_date nav_item_bookings">--}}
{{--                        <div class="">--}}
{{--                            <span>FROM</span>--}}
{{--                        </div>--}}
{{--                        <div class="bookings_nav_text">--}}
{{--                            <span>Lagos Ikeja</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="booking_nav_passenger_count nav_item_bookings">--}}
{{--                        <div class="">--}}
{{--                            <span>Passenger</span>--}}
{{--                        </div>--}}
{{--                        <div class="bookings_nav_text">--}}
{{--                            <span>{{$data['number_of_passengers']}}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--               <div class="car_hire_container">--}}
{{--                    <div class="car_hire_filter_box">--}}
{{--                      <div class="filter_header">--}}
{{--                          <div class="filter_text">--}}
{{--                              <h6>FILTER SEARCH</h6>--}}
{{--                          </div>--}}
{{--                          <div class="clear_text">--}}
{{--                              <small>clear</small>--}}
{{--                          </div>--}}
{{--                      </div>--}}
{{--                        <hr>--}}
{{--                    </div>--}}
{{--               </div>--}}
{{--            @if(count($cars) >  0)--}}
{{--            @foreach($cars as $car)--}}
{{--            <div class="cars_hire_body_box">--}}
{{--               <div class="car_list">--}}
{{--                   <div class="car_list_content">--}}
{{--                       @if(!is_null($cars))--}}
{{--                       <div class="car_img">--}}
{{--                           <img src="{{$car->car_images[0]->path}}" alt="about-us-image"  />--}}
{{--                       </div>--}}
{{--                       @endif--}}
{{--                       <div class="car_name_function_box">--}}
{{--                           <div class="car_name"><h5>{{Ucfirst($car->car_name)}}</h5></div>--}}
{{--                           <div class="car_description">--}}
{{--                               <p>--}}
{{--                                   {{ \Illuminate\Support\Str::limit($car->description, $limit = 150, $end = '...') }}--}}
{{--                               </p>--}}
{{--                           </div>--}}
{{--                           <div class="car_functionality">--}}
{{--                               <div>--}}
{{--                                  <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   />--}}
{{--                                   &#8358;  {{number_format($car->plans[0]->amount)}} Daily--}}
{{--                               </div>--}}
{{--                              <div>--}}
{{--                                  <img src="{{asset('/images/icons/functional_2.png')}}" alt="about-us-image"   />  Functional--}}
{{--                              </div>--}}
{{--                               <div>--}}
{{--                                   <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   /> {{$car->capacity}} Seat(s)--}}
{{--                               </div>--}}
{{--                               <div>--}}
{{--                                   <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   />  {{$car->carclass->name}}--}}
{{--                               </div>--}}
{{--                               <div>--}}
{{--                                   <img src="{{asset('/images/icons/functional_2.png')}}" alt="about-us-image"   />  {{$car->cartype->name}}--}}
{{--                               </div>--}}
{{--                               <div>--}}
{{--                                   <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   />--}}
{{--                                  A/C : {{$car->air_conditioning  == 1 ? 'True' : 'False'}}--}}
{{--                               </div>--}}
{{--                               <div>--}}
{{--                                   <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   />  {{Ucfirst($car->transmission)}}--}}
{{--                               </div>--}}
{{--                               <div>--}}
{{--                                   <img src="{{asset('/images/icons/functional_2.png')}}" alt="about-us-image"   /> Model : {{$car->model_year}}--}}
{{--                               </div>--}}


{{--                           </div>--}}
{{--                       </div>--}}
{{--                       <div class="car_booking_button">--}}
{{--                           <a href="{{url('select/car-plan/'.$car->id)}}">--}}
{{--                               <button>Book Now</button>--}}
{{--                           </a>--}}
{{--                       </div>--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--            </div>--}}
{{--            @endforeach--}}
{{--            @else--}}
{{--                <div class="cars_hire_body_box">--}}
{{--                    <div class="car_list">--}}
{{--                        <div class="empty_img_box">--}}
{{--                            <div class="empty_img">--}}
{{--                                <img src="{{asset('/images/illustrations/empty.jpg')}}" alt="about-us-image"  width="500" height="500"  />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="pagination_box">--}}
{{--           <div>--}}
{{--               {{ $cars->links('vendor.pagination.custom') }}--}}
{{--           </div>--}}
{{--        </div>--}}
{{--    </div>--}}


<section style="height: 226px;background: url(&quot;../../new-assets/img/Rectangle%2015%20(2).png&quot;) center / cover no-repeat;">
    <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
        <div class="container d-md-flex justify-content-md-center align-items-md-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color: var(--bs-white);text-align: center;"><strong>Hire A Vehicle</strong></h1>
                    <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Loren ipsum dolor</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="margin: 20px;border-style: none;margin-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 flex-grow-0 flex-shrink-1 flex-wrap" style="box-shadow: 1px 1px 6px 1px rgb(228,228,230);padding-top: 15px;padding-bottom: 15px;border-radius: 9px;min-height: 500px;max-height: 900px;margin-bottom: 10px;height: 750px;background: #ffffff;">
                <div class="row">
                    <div class="col">
                        <p style="margin-bottom: 0PX;font-size: 14px;"><strong>FILTER SEARCH</strong></p>
                    </div>
                    <div class="col-md-auto"><a class="text-decoration-none" href="#" style="color: #ed954d;">Clear all</a></div>
                </div>
                <hr>
                <div class="row" style="margin-bottom: 11px;">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Star Rating</strong></p>
                    </div>
                    <div class="col" style="text-align: right;">
                        <div class="dropdown" style="height: 24px;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: #ed954d;background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">Reset</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8"><label class="form-check-label" for="formCheck-8">Air Peace</label></div>
                                    </td>
                                    <td style="text-align: right;color: #afafb0;">from N 80,000</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-9"><label class="form-check-label" for="formCheck-9">Africa World Airlines</label></div>
                                    </td>
                                    <td style="text-align: right;color: #afafb0;">from N 80,000</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-7"><label class="form-check-label" for="formCheck-7">Hahn Air Systems</label></div>
                                    </td>
                                    <td style="text-align: right;color: #afafb0;">from N 80,000</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-10"><label class="form-check-label" for="formCheck-10">Ethiopian</label></div>
                                    </td>
                                    <td style="text-align: right;color: #afafb0;">from N 80,000</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Price Range</strong></p>
                    </div>
                    <div class="col" style="text-align: right;">
                        <div class="dropdown" style="height: 24px;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: #ef954d;background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">Reset</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><input class="form-range" type="range"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Cabin</strong></p>
                    </div>
                    <div class="col" style="text-align: right;">
                        <div class="dropdown" style="height: 24px;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: #ef954d;background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">Reset</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2" style="color: #afafb0;">First Class</label></div>
                            </td>
                            <td>55</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1" style="color: #afafb0;">Business Class</label></div>
                            </td>
                            <td>77</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-4"><label class="form-check-label" for="formCheck-4" style="color: #afafb0;">Economy</label></div>
                            </td>
                            <td>44</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3" style="color: #afafb0;">Premium Economy</label></div>
                            </td>
                            <td>57</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6 col-md-9" id="cruisedisplay" style="padding-left: 0px;padding-right: 0px;">
                <div class="row" id="optionline-1" style="padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 15px;margin-left: 10px;margin-right: 0px;background: var(--bs-gray-200);">
                    <div class="col" style="background: var(--bs-gray-200);border-right: 1px none #bebebe;">
                        <div class="dropdown" id="targetcenter-1" style="border-style: none;background: rgba(238,238,238,0);"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">&nbsp;Select vehicle type&nbsp;</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: left;margin-left: 20px;">SUV</p>
                    </div>
                    <div class="col" style="background: var(--bs-gray-200);border-right: 1px solid #bebebe;">
                        <div class="dropdown" style="border-style: none;background: rgba(238,238,238,0);"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">Select class</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: left;margin-left: 12px;">Executive</p>
                    </div>
                    <div class="col" style="background: var(--bs-gray-200);">
                        <div class="dropdown" id="targetcenter-3" style="border-style: none;background: rgba(238,238,238,0);text-align: center;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;text-align: left;">Type of Rental</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: left;margin-bottom: 0px;margin-left: 0px;padding-left: 35px;">Daily</p>
                    </div>
                    <div class="col mx-auto" style="background: var(--bs-gray-200);">
                        <div class="dropdown" style="border-style: none;background: rgba(238,238,238,0);"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">Sort by</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: left;margin-bottom: 0px;padding-left: 12px;">Cheapest</p>
                    </div>

                </div>
                @if(count($cars) >  0)
                @foreach($cars as $car)
                <div class="row" style="padding: 3px;">
                    <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                        <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                            <div class="col-sm-12 col-md-4 d-md-flex d-lg-flex justify-content-md-center justify-content-lg-center align-items-lg-center"><img src="{{$car->car_images[0]->path}}"></div>
                            <div class="col align-self-center">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-start">{{Ucfirst($car->car)}}</h6>
                                        <h6 class="text-start" style="font-size: 17px;"><span>{{Ucfirst($car->car_name)}}&nbsp;&nbsp;</span></h6>
                                        <p>
                                            {{ \Illuminate\Support\Str::limit($car->description, $limit = 150, $end = '...') }}
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6"><span><i class="icon ion-speedometer" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                <span style="margin-left: 5px;">&#8358;  {{number_format($car->plans[0]->amount)}} Daily</span>
                                            </div>
                                            <div class="col-6 d-md-flex align-items-md-center">
                                                <span><i class="typcn typcn-adjust-brightness" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                <span>{{Ucfirst($car->transmission)}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><span><i class="icon ion-speedometer" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                <span style="margin-left: 5px;">{{Ucfirst($car->carclass->name)}}</span>
                                            </div>
                                            <div class="col-6 d-md-flex align-items-md-center">
                                                <span><i class="typcn typcn-adjust-brightness" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                <span>{{Ucfirst($car->cartype->name)}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><span><i class="icon ion-speedometer" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                <span style="margin-left: 5px;"> A/C : {{$car->air_conditioning  == 1 ? 'True' : 'False'}}</span>
                                            </div>
                                            <div class="col-6 d-md-flex align-items-md-center">
                                                <span><i class="typcn typcn-adjust-brightness" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                <span>Model : {{$car->model_year}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><span style="font-size: 23px;"><i class="material-icons" style="color: var(--bs-orange);">airline_seat_recline_extra</i></span><span style="margin-right: 0px;margin-left: 5px;">{{$car->capacity}} Seat(s)</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center d-md-flex align-items-md-center">
                                <a href="{{url('select/car-plan/'.$car->id)}}">
                                    <button class="btn btn-primary d-md-flex" type="button" style="color: rgb(255,255,255);background: rgb(52,63,95);height: 29px;padding-top: 1px;width: 125.766px;text-align: center;">Book Now</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="row" style="padding: 3px;">
                    <div class="col" id="autopadding" style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                        <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                            <div class="col-sm-12 col-md-4 d-md-flex d-lg-flex justify-content-md-center justify-content-lg-center align-items-lg-center"></div>
                            <div class="col align-self-center">
                                <div class="center_not_found_data">
                                    <img src="{{asset('/images/illustrations/empty.jpg')}}" alt="about-us-image"  width="500" height="500"  />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="pagination_box">
            <div>
                {{ $cars->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</section>
@endsection
