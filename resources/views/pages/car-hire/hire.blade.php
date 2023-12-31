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
    .car_box{
        width:400px !important;
        height:400px !important;
    }
    a {
        text-decoration:none !important;
    }
    .my-active span{
        background-color: #5cb85c !important;
        color: white !important;
        border-color: #5cb85c !important;
    }
    .fixedPosition{
        position: fixed;
        top: 20%;
        left: 20%;
        transform: translate(-50%);
    }
</style>


{{--    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}


@section('content')
    <section style="height: 226px;background: url(&quot;../../new-assets/img/Rectangle%2015%20(2).png&quot;) center / cover no-repeat;">
        <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
            <div class="container d-md-flex justify-content-md-center align-items-md-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="color: var(--bs-white);text-align: center;"><strong>Hire A Vehicle</strong></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin: 20px;border-style: none;margin-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 flex-grow-0 flex-shrink-1 flex-wrap" style="box-shadow: 1px 1px 6px 1px rgb(228,228,230);padding-top: 15px;padding-bottom: 15px;border-radius: 9px;min-height: 500px;margin-bottom: 10px;background: #ffffff;">
                    <div class="row">
                        <div class="col">
                            <p style="margin-bottom: 0PX;font-size: 14px;"><strong>FILTER SEARCH</strong></p>
                        </div>
                        <div class="col-md-auto"><a class="text-decoration-none" href="#" style="color: #ed954d;">Clear all</a></div>
                    </div>
                    <hr>
                    <form method="get" action="{{url('filter-cars')}}">
                        @csrf
                        <div class="row" style="margin-bottom: 11px;">
                            <div class="col">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Vehicle type</strong></p>
                            </div>
                            <div class="col">
                                <div class="dropdown" id="targetcenter-1" style="border-style: none;background: rgba(238,238,238,0);">
                                    <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">&nbsp;Select vehicle type&nbsp;</button>
                                    <div class="dropdown-menu">
                                        @foreach($carTypes as $type)
                                            <form action="{{url('car-hire')}}">
                                                @csrf
                                                <input value="{{$type->id}}" type="hidden" name="class_type">
                                                <button class="dropdown-item btn" type="submit">{{$type->name}}</button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 11px;">
                            <div class="col">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Class</strong></p>
                            </div>
                            <div class="col">
                                <div class="dropdown" style="border-style: none;background: rgba(238,238,238,0);">
                                    <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">Select class</button>
                                    <div class="dropdown-menu">
                                        @foreach($carClasses as $classType)
                                            <form action="{{url('car-hire')}}">
                                                @csrf
                                                <input value="{{$classType->id}}" type="hidden" name="class_class">
                                                <button class="dropdown-item btn" type="submit">{{$classType->name}}</button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 11px;">
                            <div class="col">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Capacity</strong></p>
                            </div>
                            <div class="col">
                                <div class="dropdown" id="targetcenter-3" style="border-style: none;background: rgba(238,238,238,0);text-align: center;">
                                    <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;text-align: left;">Seat Capacity</button>
                                    <div class="dropdown-menu">
                                        @for($i = 1 ; $i <= 10 ; $i++)
                                            <form action="{{url('car-hire')}}">
                                                @csrf
                                                <input value="{{$i}}" type="hidden" name="seat_capacity">
                                                <button class="dropdown-item btn" type="submit">{{$i}}</button>
                                            </form>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-bottom: 11px;">
                            <div class="col">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Transmission</strong></p>
                            </div>
                            <div class="col">
                                <div class="dropdown" id="targetcenter-3" style="border-style: none;background: rgba(238,238,238,0);text-align: center;">
                                    <button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;text-align: left;">Select Transmission</button>
                                    <div class="dropdown-menu">
                                        @foreach($transmission as $trans)
                                            <form action="{{url('car-hire')}}">
                                                @csrf
                                                <input value="{{$trans}}" type="hidden" name="seat_capacity">
                                                <button class="dropdown-item btn" type="submit">{{$i}}</button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-borderless">--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($transmission as $trans)--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8">--}}
{{--                                                        <input class="form-check-input" type="checkbox" name="transmissions[]" value="{{$trans}}" id="formCheck-2">--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td style="text-align: right;color: #000;">{{Ucfirst($trans)}}</td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <hr>
                        <div class="row">
                            <div class="col" style="cursor:pointer;" onclick="collapse('all-locations')">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Locations</strong></p>
                            </div>
                        </div>
                        <div class="table-responsive d-none d-md-block mb-3" id="all-locations">
                            <table class="table table-borderless">
                                <tbody>
                                @foreach($states as $state)
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8">
                                                <input class="form-check-input" type="checkbox" name="locations[]" value="{{$state->id}}" id="formCheck-2">
                                            </div>
                                        </td>
                                        <td style="text-align: right;color: #000;">{{Ucfirst($state->location)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col" x-data="{ show: false }">
                            <button class="btn btn-primary" type="submit" style="font-size: 10px;background: rgba(13,110,253,0);color: var(--bs-gray-900);border-color: #010000;border-right-color: var(--bs-gray-900);" @click="showSomet()">Filter</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6 col-md-9 " id="cruisedisplay" style="padding-left: 0px;padding-right: 0px;">
                    <div class="row" id="optionline-1" style="background: var(--bs-gray-200);">
{{--                        <div class="col-3" style="background: var(--bs-gray-200);border-right: 1px none #bebebe;">--}}

                        <div class="col-3" style="background: var(--bs-gray-200);border-right: 1px solid #bebebe;">

                        </div>
                        <div class="col-3" style="background: var(--bs-gray-200);">


                            {{--                        <p style="font-weight: bold;text-align: left;margin-bottom: 0px;margin-left: 0px;padding-left: 35px;">Daily</p>--}}
                        </div>
                        {{-- <div class="col mx-auto" style="background: var(--bs-gray-200);">
                             <div class="dropdown" style="border-style: none;background: rgba(238,238,238,0);"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">Sort by</button>
                                 <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                             </div>
                             <p style="font-weight: bold;text-align: left;margin-bottom: 0px;padding-left: 12px;">Cheapest</p>
                         </div>
                     --}}

                    </div>
                    @if(count($cars) >  0)
                        @foreach($cars as $car)
                            <div class="row" style="padding: 3px;">
                                <div class="col" id="autopadding" style="padding-left: 38px;">
                                    <div class="row" style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                        <div class="col-sm-12 col-md-4 d-md-flex d-lg-flex justify-content-md-center justify-content-lg-center align-items-lg-center car_box">
                                            <img src="{{$car->car_images[0]->path}}" width="200" height="200">
                                        </div>
                                        <div class="col align-self-center">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6 class="text-start">{{Ucfirst($car->car)}}</h6>
                                                    <h6 class="text-start" style="font-size: 17px;"><span>{{Ucfirst($car->car_name)}}&nbsp;&nbsp;</span></h6>
                                                    <p>
                                                        {!!  \Illuminate\Support\Str::limit($car->description, $limit = 150, $end = '...') !!}
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6"><span><i class="icon ion-ios-cart" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                            <span style="margin-left: 5px;">&#8358;  {{number_format($car->plans[0]->amount)}} Daily</span>
                                                        </div>
                                                        <div class="col-6 d-md-flex align-items-md-center">
                                                            <span><i class="icon ion-ios-cog" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                            <span> {{Ucfirst($car->transmission)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6"><span><i class="icon ion-star" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                            <span style="margin-left: 5px;">{{Ucfirst($car->carclass->name)}}</span>
                                                        </div>
                                                        <div class="col-6 d-md-flex align-items-md-center">
                                                            <span><i class="icon ion-model-s" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                            <span> {{Ucfirst($car->cartype->name)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6"><span><i class="icon ion-ios-snowy" style="font-size: 25px;color: var(--bs-orange);"></i></span>
                                                            <span style="margin-left: 5px;"> A/C : {{$car->air_conditioning  == 1 ? 'Available' : 'NO'}}</span>
                                                        </div>
                                                        <div class="col-6 d-md-flex align-items-md-center">
                                                            <span><i class="icon ion-ios-speedometer" style="font-size: 23px;color: var(--bs-orange);"></i></span>
                                                            <span> Model: {{$car->model_year}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col"><span style="font-size: 23px;"><i class="material-icons" style="color: var(--bs-orange);">airline_seat_recline_extra</i></span><span style="margin-right: 0px;margin-left: 5px;">{{$car->capacity}} Seat(s)</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center d-md-flex align-items-md-center">
                                            <a href="{{url('view-car-details/'.$car->id)}}">
                                                <button class="btn d-md-flex" type="button"
                                                        style="color: rgb(255,255,255);
                                            background:rgb(52,63,95);
                                            text-align: center;">
                                                    View
                                                </button>
                                            </a>
                                            &nbsp; &nbsp;
                                            <a href="{{url('select/car-plan/'.$car->id)}}">
                                                <button class="btn  d-md-flex" type="button"
                                                        style="color: rgb(255,255,255);
                                                   background: rgb(52,63,95);
                                                   text-align: center;">
                                                    Book Now
                                                </button>
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
                                            <img src="{{asset('/images/illustrations/empty.jpg')}}" alt="about-us-image"  width="70%" height="80%"  />
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

                    {{ $cars->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </section>
@endsection


