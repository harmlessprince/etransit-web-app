@extends('layouts.app')

@section('content')
    <div class="bookings_box">
        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/booking_hero.png')}}'); height:200px;" >
            <div class="booking_hero_text">
                <div class="booking_hero_icon">
                    {{-- <img src="{{asset('/images/icons/arrow_left.png')}}">--}}
                </div>
                <div class="booking_text">
                    <h1>{{$service->name}}</h1>
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
                            <span>{{$pickUp->location}}</span>
                        </div>
                    </div>
                    <div class="booking_nav_destination_to nav_item_bookings">
                        <div class="">
                            <span>To</span>
                        </div>
                        <div class="bookings_nav_text">
                            <span>{{$destination->location}}</span>
                        </div>
                    </div>
                    <div class="booking_nav_departure_date nav_item_bookings">
                        <div class="">
                            <span>Departure</span>
                        </div>
                        <div class="bookings_nav_text">
                            <span>{{$data['departure_date']}}</span>
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
                            <span>{{$data['number_of_passengers']}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bookings_content">
                <div class="filter_box">
                   <div class="booking_filters">
                        <h4>filter box</h4>
                   </div>
                </div>
                <div>
                    @if(count($checkSchedule) > 0)
                    @foreach($checkSchedule as $schedule)
                    <div class="listed_buses">
                        <div class="listed_buses_items">
                            <div class="listed_bus_img">
                                <img src="{{asset('images/bus/bus.png')}}" alt="bus-image"/>
                            </div>
                            <div>
                                <div class="bookings_terminal">
                                    <h6>{{$schedule->terminal->terminal_name}}</h6>
                                </div>
                                <div class="bookings_destination_box">
                                    <span>{{$schedule->pickup->location}} -> {{$schedule->destination->location}}</span>
                                </div>
                                <div class="bookings_destination_box">
                                    <span>A/C</span>
                                </div>
                            </div>
                            <div>
                                <div class="bookings_terminal">
                                    <h6>Departure Time</h6>
                                </div>
                                <div class="bookings_destination_box">
                                    <span>{{$schedule->departure_time}}</span>
                                </div>
                            </div>
                            <div>
                                <div class="bookings_terminal">
                                    <h6>Available Seats</h6>
                                </div>
                                <div class="bookings_destination_box">
                                    <span>{{$schedule->seats_available}}</span>
                                </div>
                            </div>
                            <div>

                                <div class="bookings_destination_box transport_fare">
                                    <b> &#x20A6; {{number_format($schedule->fare_adult)}}</b>
                                </div>
                                <div class="bookings_destination_box view_seats">
                                    <a href="{{url('seat-picker/'.$schedule->id)}}">
                                        <button>View Seats</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <div class="empty_data_res">
                            <div class="listed_buses_items">
                                <div class="no_data_img">
                                    <img src="{{asset('images/illustrations/empty_data.png')}}" width="400" height="300" alt="bus-image"/>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>

@endsection
