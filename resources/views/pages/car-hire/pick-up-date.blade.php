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
                <div>
                    <form method="POST" action="{{url('plan/'.$findPaymentOption->id)}}">
                        @csrf

                        <div class="form-group">
                            <label for="date">Pick Up Date</label>
                            <input type="date" name="date" id="date" class="form-control" min="{{ date('Y-m-d') }}"
                                   required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="time">Pick Up Time</label>
                            <input type="time" name="time" id="time" class="form-control" min="{{ date('G:i') }}"
                                   required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="days">Number of Days</label>
                            <input type="number" name="days" id="days" class="form-control" required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pickup_address">Pickup Address</label>
                            <input type="text" name="pickup_address" id="pickup_address" class="form-control" required/>
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

            <div class="car_hire_info">

                <div class="car_info">
                    <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                    <small>Rental Plan :{{$findPaymentOption->plan}}</small>
                </div>
                {{--            <div class="car_info">--}}
                {{--                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>--}}
                {{--                <small>Class :{{$findPaymentOption->car->car_class}}</small>--}}
                {{--            </div>--}}
                <div class="car_info">
                    <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                    <small>Rental Fare :&#8358; {{$findPaymentOption->amount}}</small>
                </div>

                @if(!empty($findPaymentOption->extra_hour))
                    <div class="car_info">
                        <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                        <small>Extra Hour : &#8358; {{$findPaymentOption->extra_hour}} <sup>Per Hour</sup></small>
                    </div>
                @endif
                {{--            <div class="car_info">--}}
                {{--                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>--}}
                {{--                <small>Type :{{$findPaymentOption->car->car_type}}</small>--}}
                {{--            </div>--}}

                @if(!empty($findPaymentOption->extra_hour))
                    <div class="car_info">
                        <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                        <small>Rental is for a period of 12 hours</small>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function validate() {
            if (document.getElementById('self_drive').checked) {
                document.getElementById('self_drive_msg').style.display = "block";
                document.getElementById('self_drive_msg').style.transition = "all .3s;";
            } else {
                document.getElementById('self_drive_msg').style.display = "none";
                document.getElementById('self_drive_msg').style.transition = "all .3s;";
            }
        }
    </script>
@endsection
