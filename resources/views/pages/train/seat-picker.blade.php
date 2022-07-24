@extends('layouts.app')
<style>
    .passsneger_details_header_text{
        display:grid;
        grid-template-columns: repeat(4 , 1fr);
    }
    /*.passsneger_details_header_text  .passenger_text_header{*/
    /*    grid-column: 1/3;*/
    /*}*/
    /*.add_more_passeneger_icon{*/
    /*    grid-column: 3/4;*/
    /*}*/
    /*.add_more_passeneger_icon img{*/
    /*    !*margin-left: 134px;*!*/
    /*}*/
    .add_more_passeneger_icon button{
        background:#DC6513;
        padding:10px;
        color:#fff;
        text-align: center;
        border: 1px solid #DC6513;
        cursor:pointer;
        font-size:12px;
        border-radius:5px;

    }
    .add_more_passeneger_icon button:hover{
        background: #03174C;
        color:#fff;
        border:1px solid  #03174C;
        cursor:pointer;

    }

    .seat_picker_new{
        background: rgba(13,110,253,0);
        color: rgb(10,1,1);
        border :1px solid #c5c5c5 !important;
        /*border-color: #c5c5c5;*/
        /*border-left-color: #c5c5c5;*/
    }

    .selected {
        background:#4E6CBB !important;
        color:#fff !important;
        border:1px solid #E0E0E0;
    }
    .available {
        background:#fff !important;
        color:#000;
        border: 1px solid #000;
    }
    .booked{
        background:#E0E0E0 !important;
        color:#000;
        border:1px solid #E0E0E0 !important;
    }
    .route_box{
        margin-top:30px !important;
    }

</style>
@section('content')
    <section style="height: 226px;background: url('{{asset('new-assets/img/Rectangle%2015%20(2).png')}}') center / cover no-repeat;">
        <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
            <div class="container d-md-flex justify-content-md-center align-items-md-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="color: var(--bs-white);text-align: center;"><strong>Train Booking</strong></h1>
{{--                        <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Loren ipsum dolor</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding-left: 0px;background: var(--bs-gray-100);">
        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{url('/book/train/trip/'.$schedule_id)}}" id="form_submit">
            @csrf
            <input type="hidden" value="{{$trip_type}}" name="tripType" id="tripType" />
            <input type="hidden" value="{{$schedule_id}}" name="schedule_id"/>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);">
                        <div class="row passenegr_header">
                            <div class="col">
                                <h5>PASSANGER DETAILS
                                    <div class="add_more_passeneger_icon">
                                        <button id="buttonID">
                                            <img src="{{asset('images/icons/add_user_2.png')}}"  width="20" height="20" />
                                            Add More Passenger
                                        </button>
                                    </div>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="row">
                                        <div class="col" style="margin-top: 44px;">
                                            <h6>PASSANGER # 1 DETAILS</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col" style="margin-top: 28px;">
                                            <label class="form-label"  style="font-size: 14px;color: var(--bs-gray-500);">FULL NAME</label>
                                            <input class="form-control" name="full_name[]" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" value="{{auth()->user()->full_name}}" required></div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">GENDER</label>
                                            <select class="form-select" name="gender[]" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;background: rgba(255,255,255,0);" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select></div>
                                        <div class="col d-block">
                                            <div class="row d-md-flex">
                                                <div class="col-md-12"><label class="col-form-label" style="font-size: 14px;color: var(--bs-gray-500);">AGE GROUP</label></div>
                                                <div class="col-md-12 d-inline-flex" style="padding-right: 0px;padding-left: 5px;">
                                                    <div class="form-check d-inline-flex" style="margin-left: 1px;">
                                                        <input class="form-check-input" name="passenger_option[]"  value="adult" type="checkbox" id="formCheck-1">
                                                        <label class="form-check-label" for="formCheck-1" style="font-size: 14px;">&nbsp;Adult</label>
                                                    </div>
                                                    <div class="form-check d-inline-flex" style="margin-left: 18px;">
                                                        <input class="form-check-input" name="passenger_option[]"  value="children" type="checkbox" id="formCheck-2" >
                                                        <label class="form-check-label" for="formCheck-2" style="font-size: 14px;">&nbsp; Child</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group passenger_name">
                                            <div><label class="form-label" style="font-size: 14px; margin-top:15px;color: var(--bs-gray-500);">NEXT OF KIN FULL NAME</label></div>
                                            <div><input type="text" name="next_of_kin_full_name[]"  class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                        </div>
                                        <div class="form-group passenger_name">
                                            <div><label class="form-label" style="font-size: 14px;margin-top:15px;color:  var(--bs-gray-500);">NEXT OF KIN NUMBER</label></div>
                                            <div><input type="text" name="next_of_kin_phone_number[]" class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                        </div>
                                        <div class="col-md-12 route_box">
                                            <div class="form-group" >
                                                <select class="form-control" name="route_id[]">
                                                    <option value="">Select a route</option>
{{--                                                    @foreach($routeFare as $index => $fare)--}}
{{--                                                        @foreach($fare as $i => $scheduleFare)--}}
{{--                                                            <option  value="{{$scheduleFare[$i]->id}}">{{$scheduleFare[$i]->terminal->stop_name}} - {{$scheduleFare[$i]->destination_terminal->stop_name}}--}}
{{--                                                                ({{$scheduleFare[$i]->seatClass->class}}) - (&#8358; {{number_format($scheduleFare[$i]->amount_adult)}} (Adult Fare) -  &#8358; {{number_format($scheduleFare[$i]->amount_child)}} (Children Fare) )</option>--}}
{{--                                                    <option  value="{{$fare[$index]->id}}">{{$fare[$index]->terminal->stop_name}} - {{$fare[$index]->destination_terminal->stop_name}}--}}
{{--                                                        ({{$fare[$index]->seatClass->class}}) - (&#8358; {{number_format($fare[$index]->amount_adult)}} (Adult Fare) -  &#8358; {{number_format($fare[$index]->amount_child)}} (Children Fare) )</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endforeach--}}

                                                    @foreach($routeFare as $index => $fare)
                                                                <option  value="{{$fare->id}}">{{$fare->terminal->stop_name}} - {{$fare->destination_terminal->stop_name}}
                                                                    ({{$fare->seatClass->class}}) - (&#8358; {{number_format($fare->amount_adult)}} (Adult Fare) -
                                                                    &#8358; {{number_format($fare->amount_child)}} (Children Fare) )
                                                                </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="passenger_details_form_input">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" id="secondtab" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;margin-top: 0px;padding-left: 90px;padding-right: 30px;">
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;padding-left: 5px;">
                                <p style="font-weight: bold;">Choose Seats&nbsp;<i class="material-icons" style="margin-top: 2px;padding-top: 3px;color: rgb(42,66,136);">airline_seat_recline_extra</i></p>
                            </div>
                            <div class="col-md-12 d-inline-flex flex-row">
                                <div class="form-check" style="padding-left: 15px;"><input class="form-check-input" type="checkbox" id="formCheck-7" style="color: rgb(52,63,95);background: rgb(52,63,95);"><label class="form-check-label" for="formCheck-7">Selected</label></div>
                                <div class="form-check" style="padding-left: 40px;"><input class="form-check-input" type="checkbox" id="formCheck-8" style="background: var(--bs-gray-400);"><label class="form-check-label" for="formCheck-8">Booked</label></div>
                                <div class="form-check" style="padding-left: 40px;"><input class="form-check-input" type="checkbox" id="formCheck-9"><label class="form-check-label" for="formCheck-9">Available</label></div>
                            </div>
                        </div>
                        @if(!is_null($trainSeatsPicker['first_class_seat']))
                        <div class="row" style="margin-top: 53px;padding: 24px;box-shadow: 1px 1px 6px rgb(231,231,231);border-left-width: 1px;border-radius: 20px;width: 252px;margin-left: 13px;">
                            <h5><b>First Class</b></h5>
                            @foreach($trainSeatsPicker['first_class_seat'] as $seat)
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;"></div>
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;"></div>
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;">
                                            <a  href="{{$seat['id']}}"
                                                @if($seat['booked_status'] == 0)     class="available seat_selector btn seat_picker_new"
                                                @elseif($seat['booked_status'] == 1) class="seat_selector available_indicator btn seat_picker_new"
                                                @elseif($seat['booked_status'] == 2) class="booked seat_selector btn seat_picker_new"  @endif
                                                style="width:43.25px;">{{$seat['coach_type']}}</a></div>
                                    </div>
                                </div>
                            @endforeach
                            @endif

                            @if(!is_null($trainSeatsPicker['business_class_seat']))
                            <h5><b>Business Class</b></h5>
                            @foreach($trainSeatsPicker['business_class_seat'] as $seat)
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;"></div>
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;"></div>
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;">
                                            <a  href="{{$seat['id']}}"
                                                @if($seat['booked_status'] == 0)     class="available seat_selector btn seat_picker_new"
                                                @elseif($seat['booked_status'] == 1) class="seat_selector available_indicator btn seat_picker_new"
                                                @elseif($seat['booked_status'] == 2) class="booked seat_selector btn seat_picker_new"  @endif
                                                style="width:43.25px;">{{$seat['coach_type']}}</a></div>
                                    </div>
                                </div>
                            @endforeach
                            @endif

                            @if(!is_null($trainSeatsPicker['economy_class_seat']))
                            <h5><b>Economy Class</b></h5>
                            @foreach($trainSeatsPicker['economy_class_seat'] as $seat)
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;"></div>
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;"></div>
                                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center" style="margin-top: 10px;margin-bottom: 10px;">
                                            <a  href="{{$seat['id']}}"
                                                @if($seat['booked_status'] == 0)     class="available seat_selector btn seat_picker_new"
                                                @elseif($seat['booked_status'] == 1) class="seat_selector available_indicator btn seat_picker_new"
                                                @elseif($seat['booked_status'] == 2) class="booked seat_selector btn seat_picker_new"  @endif
                                                style="width:43.25px;">{{$seat['coach_type']}}</a></div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-md-flex justify-content-center align-items-center align-content-center align-self-center justify-content-md-center" style="text-align: center;margin-top: 14px;padding-bottom: 17px;"><button class="btn btn-primary" type="submit" style="width: 235.422px;background: rgb(52,63,95);">CONTINUE TO PAYMENT</button></div>
                </div>
            </div>
        </form>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(".seat_selector").click(function(e){
            e.preventDefault();
            $(this).removeClass("available");
            $(this).addClass("selected");
            var id = $(this).attr('href');
            console.log(id)
            let user_id = {{auth()->user()->id}};
            let trip_type = $("input[name='tripType']").val();
            let train_id = {{$tranId}};
            console.log(train_id)
            let train_schedule_id = {{$train_schedule_id}};
            $.ajax({
                type:'POST',
                url: "{{ route('train.select-seat') }}",
                //"/seat-selector-tracker/",
                data:{"_token": "{{ csrf_token() }}",train_seat_tracker_id:id  ,trip_type ,train_id  , train_schedule_id},
                success:function(data){
                    if(data.success)
                    {
                        displaySuccessMessage(data.message)
                    }else{
                        displayErrorMessage(data.message)
                    }
                }
            });
        });

        $(".seat_selector").dblclick(function(e) {
            e.preventDefault();
            $(this).addClass("available");
            $(this).removeClass("selected");
            var id = $(this).attr('href');
            var user_id = {{auth()->user()->id}}
            var trip_type = $("input[name='tripType']").val();
            var train_id = {{$tranId}}

            $.ajax({
                type:'POST',
                url:  "{{ route('train.de-select-seat') }}",
                data:{"_token": "{{ csrf_token() }}",train_seat_tracker_id:id  ,trip_type  ,train_id  , train_schedule_id},
                success:function(data){
                    if(!data.success)
                    {
                        displayErrorMessage(data.message)
                    }
                }
            });
        });


        $('#buttonID').click(function(e){
            e.preventDefault();
            $('.passenger_details_form_input').append(` <div class="row">
                                    <div class="col" style="margin-top: 28px;">
                                <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">FULL NAME</label>
                                <input class="form-control" name="full_name[]" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"></div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">GENDER</label>
                                        <select class="form-select" name="gender[]" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;background: rgba(255,255,255,0);">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select></div>
                                    <div class="col d-block">
                                        <div class="row d-md-flex">
                                            <div class="col-md-12"><label class="col-form-label" style="font-size: 14px;color: var(--bs-gray-500);">AGE GROUP</label></div>
                                            <div class="col-md-12 d-inline-flex" style="padding-right: 0px;padding-left: 5px;">
                                                <div class="form-check d-inline-flex" style="margin-left: 1px;">
                                                    <input class="form-check-input" type="checkbox" name="passenger_option[]" value="adult" id="formCheck-1">
                                                    <label class="form-check-label" for="formCheck-1" style="font-size: 14px;">&nbsp; Adult</label></div>
                                                <div class="form-check d-inline-flex" style="margin-left: 18px;">
                                                    <input class="form-check-input" type="checkbox" name="passenger_option[]" value="children" id="formCheck-2" >
                                                    <label class="form-check-label" for="formCheck-2" style="font-size: 14px;">&nbsp; Child</label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passenger_name">
                                    <div><label class="form-label" style="font-size: 14px; margin-top:15px; color: var(--bs-gray-500);">NEXT OF KIN FULL NAME</label></div>
                                    <div><input type="text" name="next_of_kin_full_name[]"  class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                </div>
                                <div class="form-group passenger_name">
                                    <div><label class="form-label" style="font-size: 14px; margin-top:15px; color: var(--bs-gray-500);">NEXT OF KIN NUMBER</label></div>
                                    <div><input type="text" name="next_of_kin_phone_number[]" class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                </div>
                                 <div class="col-md-12 route_box">
                                            <div class="form-group" >
                                                <select class="form-control" name="route_id[]">
                                                    <option value="">Select a route</option>
                                                    @foreach($routeFare as $fare)
                                                  <option  value="{{$fare->id}}">{{$fare->terminal->stop_name}} - {{$fare->destination_terminal->stop_name}}
                                                     ({{$fare->seatClass->class}}) - (&#8358; {{number_format($fare->amount_adult)}} (Adult Fare) -  &#8358; {{number_format($fare->amount_child)}} (Children Fare) )</option>
                                                    @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                    </div>`);
                                 });

        function displayErrorMessage(message) {
            toastr.error(message, 'Error');
        }

        function displaySuccessMessage(message) {
            toastr.success(message, 'Success');
        }


    </script>
@endsection
