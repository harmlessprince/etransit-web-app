@extends('layouts.app')
<style>
    .date_picker_box {
        background: white;
        padding: 20px;
        margin-top: 90px;
        box-shadow: 1px 2px 1px 2px rgba(182, 181, 181, 0.6);
        border-radius: 10px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        margin-bottom: 100px;
    }

    #date, #time, #days, #pickup_address {
        border: none;
        border-bottom: 1px solid #DC6513 !important;
        outline: none;
    }

    .pick_btn button {
        background: #021037;
        padding: 10px;
        color: #fff;
        border-radius: 10px;
        border: 1px solid #021037;
    }

    .pick_btn button:hover {
        background: #DC6513;
        border: 1px solid #DC6513;
    }

    .car_hire_info {
        text-align: center;
        background: #fff;

    }

    .car_info {
        font-size: 25px;
        color: #021037;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    #self_drive_msg {
        display: none;
    }

</style>
@section('content')
    <div class="container">
        <br><br>
        <div class="alert alert-primary display_self_driveMsg" role="alert" id="self_drive_msg">
            <h6>Please Note : information listed below will be required to hire a self driven car.</h6>
            <ul>
                <li>Internation passport !</li>
                <li>BVN/NIN !</li>
                <li>Verified Address !</li>
            </ul>

        </div>
        <div class="date_picker_box">
            <div class="date_picker_form">
                <div class="pac-card" id="pac-card">
                    <form method="POST" action="{{url('plan/'.$findPaymentOption->id)}}">
                        @csrf

                        <div class="form-group">
                            <label for="date">Pick Up Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}"
                                   required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="time">Pick Up Time</label>
                            <input type="time" name="time" id="time" class="form-control" value="{{ old('time') }}"
                                   required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="days">Number of Days</label>
                            <input type="number" name="days" id="days" class="form-control" value="{{ old('days') }}"
                                   required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="pac-card" id="pac-card">
                                <div style="display: none;">
                                    <div id="type-selector" class="pac-controls">
                                        <input
                                            type="radio"
                                            name="type"
                                            id="changetype-all"
                                            checked="checked"
                                        />
                                        <label for="changetype-all">All</label>

                                        <input type="radio" name="type" id="changetype-establishment"/>
                                        <label for="changetype-establishment">establishment</label>

                                        <input type="radio" name="type" id="changetype-address"/>
                                        <label for="changetype-address">address</label>

                                        <input type="radio" name="type" id="changetype-geocode"/>
                                        <label for="changetype-geocode">geocode</label>

                                        <input type="radio" name="type" id="changetype-cities"/>
                                        <label for="changetype-cities">(cities)</label>

                                        <input type="radio" name="type" id="changetype-regions"/>
                                        <label for="changetype-regions">(regions)</label>
                                    </div>
                                    <br/>
                                    <div id="strict-bounds-selector" class="pac-controls">
                                        <input type="checkbox" id="use-location-bias" value="" checked/>
                                        <label for="use-location-bias">Bias to map viewport</label>

                                        <input type="checkbox" id="use-strict-bounds" value=""/>
                                        <label for="use-strict-bounds">Strict bounds</label>
                                    </div>
                                </div>
                                <div id="pac-container">
                                    <label for="pickup_address">Pickup Address</label>
                                    <input id="pickup_address" name="pickup_address" type="text" class="form-control"
                                           placeholder="Enter a pickup address" value="{{ old('pickup_address') }}"/>
                                </div>
                            </div>
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <span id="place-name" class="title"></span><br/>
                                <span id="place-address"></span>
                            </div>
                        </div>
                        <br>

                        {{--                        <div class="form-group">--}}
                        {{--                            @if($findPaymentOption->car->self_drive == 'active')--}}
                        {{--                                <span>Enable Self Drive</span>--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <div class="switch_box">--}}
                        {{--                                        <div>--}}
                        {{--                                            <label class="switch">--}}
                        {{--                                                <input type="checkbox" class="self_drive" id="self_drive"--}}
                        {{--                                                       name="self_drive" onchange="validate()">--}}
                        {{--                                                <span class="slider round"></span>--}}
                        {{--                                            </label>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <br>--}}
                        {{--                            @else--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <span>Self Drive disabled for this car</span>--}}
                        {{--                                    <div class="form-group">--}}
                        {{--                                        <div class="switch_box">--}}
                        {{--                                            <div>--}}
                        {{--                                                <label class="switch">--}}
                        {{--                                                    <input type="checkbox" class="self_drive" id="self_drive"--}}
                        {{--                                                           disabled>--}}
                        {{--                                                    <span class="slider round"></span>--}}
                        {{--                                                </label>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <br>--}}
                        {{--                            @endif--}}
                        {{--                        </div>--}}
                        <div class="pick_btn">
                            <button>Add Pick Up Information</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="car_hire_info" style="text-align: left;">

                <ul class="list-unstyled" style="margin-left:2em;">
                    <li>
                        <div class="car_info">
                            <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                            <small>Rental Plan :{{ $findPaymentOption->plan }}</small>
                        </div>
                    </li>

                    {{--                    <li>--}}
                    {{--            <div class="car_info">--}}
                    {{--                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>--}}
                    {{--                <small>Class :{{$findPaymentOption->car->car_class}}</small>--}}
                    {{--            </div>--}}
                    {{--                    </li>--}}
                    <li>
                        <div class="car_info">
                            <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                            <small>Rental Fare :&#8358; {{ number_format($findPaymentOption->amount,2) }}</small>
                        </div>
                    </li>
                    @if(!empty($findPaymentOption->extra_hour))
                        <li>
                            <div class="car_info">
                                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                                <small>Extra Hour : &#8358; {{ number_format($findPaymentOption->extra_hour,2) }} <sup>Per
                                        Hour</sup></small>
                            </div>
                        </li>
                    @endif
                    {{--                    <li>--}}
                    {{--            <div class="car_info">--}}
                    {{--                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>--}}
                    {{--                <small>Type :{{$findPaymentOption->car->car_type}}</small>--}}
                    {{--            </div>--}}
                    {{--                    </li>               --}}
                    @if(!empty($findPaymentOption->extra_hour))
                        <li>
                            <div class="car_info">
                                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                                <small>Rental is for a period of 12 hours</small>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl3OQUTqcOTP55fo2Z089F6IThkJIyako&callback=initMap&libraries=places&v=weekly"
        defer></script>

    <script type="text/javascript">


        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 40.749933, lng: -73.98633},
                zoom: 13,
                mapTypeControl: false,
            });
            const card = document.getElementById("pac-card");
            const input = document.getElementById("pickup_address");
            const biasInputElement = document.getElementById("use-location-bias");
            const strictBoundsInputElement = document.getElementById("use-strict-bounds");
            const options = {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
            };

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo("bounds", map);

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);

            const marker = new google.maps.Marker({
                map,
                anchorPoint: new google.maps.Point(0, -29),
            });

            autocomplete.addListener("place_changed", () => {
                infowindow.close();
                marker.setVisible(false);

                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent =
                    place.formatted_address;
                infowindow.open(map, marker);
            });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                const radioButton = document.getElementById(id);

                radioButton.addEventListener("click", () => {
                    autocomplete.setTypes(types);
                    input.value = "";
                });
            }

            setupClickListener("changetype-all", []);
            setupClickListener("changetype-address", ["address"]);
            setupClickListener("changetype-establishment", ["establishment"]);
            setupClickListener("changetype-geocode", ["geocode"]);
            setupClickListener("changetype-cities", ["(cities)"]);
            setupClickListener("changetype-regions", ["(regions)"]);
            biasInputElement.addEventListener("change", () => {
                if (biasInputElement.checked) {
                    autocomplete.bindTo("bounds", map);
                } else {
                    // User wants to turn off location bias, so three things need to happen:
                    // 1. Unbind from map
                    // 2. Reset the bounds to whole world
                    // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
                    autocomplete.unbind("bounds");
                    autocomplete.setBounds({east: 180, west: -180, north: 90, south: -90});
                    strictBoundsInputElement.checked = biasInputElement.checked;
                }

                input.value = "";
            });
            strictBoundsInputElement.addEventListener("change", () => {
                autocomplete.setOptions({
                    strictBounds: strictBoundsInputElement.checked,
                });
                if (strictBoundsInputElement.checked) {
                    biasInputElement.checked = strictBoundsInputElement.checked;
                    autocomplete.bindTo("bounds", map);
                }

                input.value = "";
            });
        }

        window.initMap = initMap;
    </script>
@endsection
