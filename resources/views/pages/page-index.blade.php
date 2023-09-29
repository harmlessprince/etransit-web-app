@extends('layouts.app')
<style>
    .container-case {
        width: 100%;

    }

    .container-main {
        width: 100%;
    }

    .hero-main {
        width: 100%;
        height: calc(100vh - 110px);
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url("/images/bg/hero-bg.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .text {
        width: 50%;
        color: #fff;
    }

    @media screen and (max-width: 768px) {
        .text {
            width: 80%;
        }
    }

</style>
@section('content')
    <div class="container-fluid hero-bg ">
        <div class="hero-bg-section ">
            <div class="hero-bg-text">
                <p>Our 24 Hour's Service</p>
                <h1>EASY , SAFE AND CONVENIENT </h1>
                <small class="hero-sm-text">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                    roots
                    in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                    <br> Richard McClintock, a Latin professor at Hampden-Sydney College i</small>
            </div>
        </div>
        <div class="ticketing-section">
            <div class="ticketing-box">
                <div class="ticket-box-menu">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Co-Traveller</a>
                        </li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Train
                                Ticket</a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab"
                                                   data-toggle="tab">Ferry Booking</a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
                                                   data-toggle="tab">Flight Booking</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="bus-booking-box">
                                <div class="bus-booking-content">
                                    <form method="POST" action="{{url('/bus/bookings')}}">
                                        @csrf
                                        <div class="booking-trip-button">
                                            <button id="trip-btn" class="toggle-single-trip-btn">One Way</button>
                                            <button id="round-trip-btn" class="toggle-round-trip-btn" name="round_trip">
                                                Round Trip
                                            </button>
                                        </div>
                                        <div class="departure_box">
                                            <div class="bus-booking-departure-date">
                                                <div class="date_picker">
                                                    <label for="departure" class="departure_label">Departure
                                                        Date</label>
                                                    <input type="date" name="departure_date" id="departure" required/>
                                                </div>
                                                <div class="date_picker return_date" style="display:none;">
                                                    <label for="return_date" class="departure_label">Return Date</label>
                                                    <input type="date" name="return_date" id="departure"/>
                                                </div>
                                                {{--                                                <div class="departure_day_box">--}}
                                                {{--                                                    <span class="departure_day">TODAY | TOMORROW </span>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <input type="hidden" name="service_id" value="{{$busService->id}}"/>
                                            <input type="hidden" name="trip_type" class="one-way-trip-input"
                                                   id="trip-form" value="1" disabled/>
                                            <input type="hidden" name="trip_type" class="round-way-trip-input"
                                                   id="round-trip=form" value="2" disabled/>
                                            <div class="form-group number_of_passengers">
                                                <label for="number_of_persons" class="departure_count">NUMBER OF
                                                    PERSONS</label>
                                                <select id="number_of_persons" class="passengers"
                                                        name="number_of_passengers" required>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p>LOCATION</p>
                                        <div>
                                            <div class="travelling_select_box">
                                                <div class="travelling_from_box">
                                                    <label for="travelling_from" class="departure_label">Travelling
                                                        From</label>
                                                    <select name="destination_from" id="travelling_from">
                                                        @foreach($locations as $location)
                                                            <option
                                                                value="{{$location->id}}">{{$location->location}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="travelling_to_box">
                                                    <label for="travelling_to" class="travelling_to_label">Travelling
                                                        To</label>
                                                    <select name="destination_to" id="travelling_to">
                                                        @foreach($locations as $location)
                                                            <option
                                                                value="{{$location->id}}">{{$location->location}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="proceed_button_box">
                                                <button class="proceed_button">PROCEED</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">... hxhxhxhhxhx</div>
                        <div role="tabpanel" class="tab-pane" id="messages">..aaaaaaa.</div>
                        <div role="tabpanel" class="tab-pane" id="settings">...aaanananana</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us-box">
            <div class="about_us">
                <div>
                    <h1>ABOUT US</h1>
                    <h4 class="about_us_welcome_header">WELCOME TO E-TRANSIT</h4>
                </div>
            </div>
            <div class="about_us_box">
                <div>
                    <div class="about_us_content about_us_text">
                        <div>
                            <h5 class="about_e_transit_header">ABOUT <br/> <span
                                    class="about_e_transit"> E-TRANSIT </span></h5>
                        </div>
                        <div>
                            <p class="about_paragragh">
                                Etransit Africa is an African-focused transportation service company that exists to
                                provide individuals
                                and cooperate bodies with satisfactory transportation services on a timely and
                                consistent basis.
                            </p>
                            <p class="about_paragragh"> The company started operations in 2019 as an interstate
                                transport company in Nigeria but projects
                                to provide transportation services across Africa. Our team of highly trained
                                professionals are always
                                working towards making each travel experience worth every penny.
                                Read more
                            </p>
                        </div>

                    </div>
                    <div class="about_us_content">
                        <div>
                            <h5 class="why_choose_us_header">WHY <br/><span class="why_choose_us_header_text"> CHOOSE US ? </span>
                            </h5>
                        </div>
                        <div class="about_us_text about_paragragh">
                            <h6>SAVE MORE</h6>
                            <p class="why_choose_us">Get the best affordable rates. Book your trips with us today</p>
                            <h6>RELIABLE</h6>
                            <p class="why_choose_us"> Don’t get stuck with the rest, journey with the best.</p>
                            <h6>GREAT FEEDBACK</h6>
                            <p class="why_choose_us">Your safety and comfort is our number one priority</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div><img src="{{asset('images/about-us/about-us.png')}}" alt="about-us-image" class="about_us_img"
                              height="400px"/></div>
                </div>
            </div>
        </div>
        <div class="discount_bg">
            <div>
                <img src="{{asset('images/discount/discount_bus.png')}}" alt="about-us-image" class="discount_bus_img"
                     height="350px"/>
            </div>
            <div class="discount_text">
                <div>
                    <p>ENJOY</p>
                    <h3>30%</h3>
                    <h3 class="discount_text" style="margin-left:-35px;">Discount</h3>
                    <span>ON</span>
                    <p style="margin-left:5px;">YOUR</p>
                    <p style="margin-left:-35px;">INTERSTATE TRIP</p>
                    <button class="get_started_btn">GET STARTED</button>
                </div>
            </div>
            <div>
                <img src="{{asset('images/discount/discount_plane.png')}}" alt="about-us-image"
                     class="discount_plane_img plane_img" height="300px"/>
            </div>
        </div>
        <div class="trending_vehicle_section">
            <div class="trending_header_text">
                <div>
                    <h3>TRENDING VEHICLES</h3>
                    <p> BOOK EXCLUSIVE VEHICLES TO MOVE YOU AROUND</p>
                </div>
            </div>
            <div class="trending_vehicle_items">
                <div class="trending_vehicle_item">
                    <div class="vehicle_image">
                        <img src="{{asset('/images/trending/vehicle.png')}}" alt="about-us-image"
                             class="discount_plane_img" height="300px"/>
                    </div>
                    <div class="vehicle_name">
                        <p>Lexus RX 361</p>
                    </div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/auto.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/seater.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/functional.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
                <div class="trending_vehicle_item">
                    <div class="vehicle_image"><img src="{{asset('images/trending/vehicle.png')}}" alt="about-us-image"
                                                    class="discount_plane_img" height="300px"/></div>
                    <div class="vehicle_name"><p>Lexus RX 362</p></div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/auto.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/seater.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/functional.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
                <div class="trending_vehicle_item">
                    <div class="vehicle_image">
                        <img src="{{asset('images/trending/vehicle.png')}}" alt="about-us-image"
                             class="discount_plane_img" height="300px"/>
                    </div>
                    <div class="vehicle_name">
                        <p>Lexus RX 360</p>
                    </div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/auto.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/seater.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/functional.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
                <div class="trending_vehicle_item">
                    <div class="vehicle_image">
                        <img src="{{asset('images/trending/vehicle.png')}}" alt="about-us-image"
                             class="discount_plane_img" height="300px"/>
                    </div>
                    <div class="vehicle_name">
                        <p>Lexus RX 360</p>
                    </div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/auto.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/seater.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img src="{{asset('images/icons/functional.png')}}" alt="auto-image" class="auto-icons"
                                      height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="client_section ">
            <div class="clients">
                <div class="client_header_text">
                    <h3>SOME HAPPY CLIENTS</h3>
                </div>
                <div class="client_logo row">
                    <div>
                        <img src="{{asset('images/clients/client_1.png')}}" alt="client-image" class="client_img"
                             height="150"/>
                    </div>
                    <div>
                        <img src="{{asset('images/clients/client_2.png')}}" alt="client-image" class="client_img"
                             height="150"/>
                    </div>
                    <div>
                        <img src="{{asset('images/clients/client_3.png')}}" alt="client-image" class="client_img"/>
                    </div>
                    <div>
                        <img src="{{asset('images/clients/client_4.png')}}" alt="client-image" class="client_img"
                             height="150"/>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
        <script type="text/javascript">
            document.getElementById("trip-btn").addEventListener("click", function (event) {
                event.preventDefault()


                document.getElementById("trip-btn").style.backgroundColor = "#03174C";
                document.getElementById("trip-btn").style.color = "#ffffff";
                document.getElementById("trip-form").style.display = "block";

                document.getElementById("round-trip-btn").style.backgroundColor = "#F2F2F2";
                document.getElementById("round-trip-btn").style.color = "black";
                document.getElementById("round-trip-form").style.display = "none";
            });

            document.getElementById("round-trip-btn").addEventListener("click", function (event) {
                event.preventDefault()
                document.getElementById("round-trip-btn").style.backgroundColor = "#03174C";
                document.getElementById("round-trip-btn").style.color = "#fff";
                document.getElementById("trip-btn").style.backgroundColor = "#F2F2F2";
                document.getElementById("trip-btn").style.color = "black";
            });
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(".toggle-single-trip-btn").click(function (e) {
                e.preventDefault();
                $('.one-way-trip-input').removeAttr('disabled');
                $('.round-way-trip-input').attr('disabled', 'disabled');
                $(".return_date").hide();

            });

            $(".toggle-round-trip-btn").click(function (e) {
                e.preventDefault();
                $('.round-way-trip-input').removeAttr('disabled');
                $('.one-way-trip-input').attr('disabled', 'disabled');
                $(".return_date").show();
                // $(".return_date").css("display", "block");
            });


            function displayErrorMessage(message) {
                toastr.error(message, 'Error');
            }

        </script>

@endsection
