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
</style>
@section('content')
    <div class="bookings_box">
        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/booking_hero.png')}}'); height:200px;" >
            <div class="booking_hero_text">
                <div class="booking_hero_icon">
                    {{-- <img src="{{asset('/images/icons/arrow_left.png')}}">--}}
                </div>
                <div class="booking_text">
                    <h1>Car Hire</h1>
                    <span>Lorem ipsum text here  Lorem ipsum text here Lorem ipsum text here</span>
                </div>
            </div>

        </div>
        <div class="booking_nav_box">
            <div class="booking_nav_content">
                <div class="booking_nav_item">
                    <div class="booking_nav_destination_from nav_item_bookings">
                        <div class="">
                            <span>From</span>
                        </div>
                        <div class="bookings_nav_text">
{{--                            <span>{{$pickUp->location}}</span>--}}
                        </div>
                    </div>
                    <div class="booking_nav_destination_to nav_item_bookings">
                        <div class="">
                            <span>To</span>
                        </div>
                        <div class="bookings_nav_text">
{{--                            <span>{{$destination->location}}</span>--}}
                        </div>
                    </div>
                    <div class="booking_nav_departure_date nav_item_bookings">
                        <div class="">
                            <span>Departure</span>
                        </div>
                        <div class="bookings_nav_text">
{{--                            <span>{{$data['departure_date']}}</span>--}}
                        </div>
                    </div>
                    <div class="booking_nav_return_date nav_item_bookings">
                        <div class="">
                            <span>FROM</span>
                        </div>
                        <div class="bookings_nav_text">
                            <span>Lagos Ikeja</span>
                        </div>
                    </div>
                    <div class="booking_nav_passenger_count nav_item_bookings">
                        <div class="">
                            <span>Passenger</span>
                        </div>
                        <div class="bookings_nav_text">
{{--                            <span>{{$data['number_of_passengers']}}</span>--}}
                        </div>
                    </div>
                </div>
            </div>
               <div class="car_hire_container">
                    <div class="car_hire_filter_box">
                      <div class="filter_header">
                          <div class="filter_text">
                              <h6>FILTER SEARCH</h6>
                          </div>
                          <div class="clear_text">
                              <small>clear</small>
                          </div>
                      </div>
                        <hr>
                    </div>
               </div>
            </div>
        </div>
    </div>

@endsection
