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

</style>
@push('css')

@endpush

@section('content')
    <div class="bookings_box">
        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/booking_hero.png')}}'); height:200px;" >
            <div class="booking_hero_text">
                <div class="booking_hero_icon">
                     <img src="{{asset('/images/icons/arrow_left_2.png')}}">
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
            @if(count($cars) >  0)
            @foreach($cars as $car)
            <div class="cars_hire_body_box">
               <div class="car_list">
                   <div class="car_list_content">
                       <div class="car_img">
                           <img src="{{asset('/images/trending/vehicle.png')}}" alt="about-us-image"   />
                       </div>
                       <div class="car_name_function_box">
                           <div class="car_name"><h5>{{Ucfirst($car->car_type)}}</h5></div>
                           <div class="car_description">
                               <p>
                                   {{ \Illuminate\Support\Str::limit($car->description, $limit = 150, $end = '...') }}
                               </p>
                           </div>
                           <div class="car_functionality">
                               <div>
                                  <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   />  389m
                               </div>
                              <div>
                                  <img src="{{asset('/images/icons/functional_2.png')}}" alt="about-us-image"   />  Functional
                              </div>
                               <div>
                                   <img src="{{asset('/images/icons/seat_2.png')}}" alt="about-us-image"   /> {{$car->capacity}} adults
                               </div>
                           </div>
                       </div>
                       <div class="car_booking_button">
                           <a href="{{url('select/car-plan/'.$car->id)}}">
                               <button>Book Now</button>
                           </a>
                       </div>
                   </div>
               </div>
            </div>
            @endforeach
            @else
                <div class="cars_hire_body_box">
                    <div class="car_list">
                        <div class="empty_img_box">
                            <div class="empty_img">
                                <img src="{{asset('/images/illustrations/empty.jpg')}}" alt="about-us-image"  width="500" height="500"  />
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

@endsection
