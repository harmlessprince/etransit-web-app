@extends('layouts.app')
{{--<style>--}}
{{--    .toast {--}}
{{--        flex-basis: 350px;--}}
{{--        max-width: 350px;--}}
{{--        font-size: 0.875rem;--}}
{{--        background-color: rgb(155 32 32 / 85%) !important;--}}
{{--        background-clip: padding-box;--}}
{{--        border: 1px solid rgb(155 32 32 / 85%) !important;--}}
{{--        box-shadow: 0 0.25rem 0.75rem rgb(0 0 0 / 10%) !important;--}}
{{--        opacity: 0;--}}
{{--        border-radius: 0.25rem;--}}
{{--    }--}}
{{--</style>--}}
<style>
    .passsneger_details_header_text{
        display:grid;
        grid-template-columns: repeat(4 , 1fr);
    }
    .passsneger_details_header_text  .passenger_text_header{
        grid-column: 1/3;
    }
    .add_more_passeneger_icon{
        grid-column: 3/4;
    }
    .add_more_passeneger_icon img{
        /*margin-left: 134px;*/
    }
    .add_more_passeneger_icon button{
        background:#DC6513;
        padding:10px;
        color:#fff;
        text-align: center;
        border: 1px solid #DC6513;
        cursor:pointer;
        margin-left: -275px;
        font-size:12px;
        border-radius:5px;

    }
    .add_more_passeneger_icon button:hover{
        background: #03174C;
        color:#fff;
        border:1px solid  #03174C;
        cursor:pointer;

    }


</style>
@section('content')
    <div class="seat_picker_nav"></div>
    <div class="container passenger_box">
        <form method="POST" action="{{url('/book/trip/'.$schedule_id)}}" id="form_submit">
            @csrf
            <div class="passsneger_details_header_text">
                <div class="passenger_text_header">
                    <h4>Passenger  Details </h4>
                </div>
                <div class="add_more_passeneger_icon">
                    <button id="buttonID"> <img src="{{asset('images/icons/add_user_2.png')}}"  width="20" height="20" /> Add More Passenger</button>
                </div>

            </div>

            <div class="passenger_form_container">
            <div class="passenger_info_box">
                <div class="passenger_details_form">
                    <div >
                        <div class="form-group passenger_name">
                           <div><label>FULL NAME</label></div>
                            <div><input type="text" name="full_name[]" value="{{auth()->user()->full_name}}"  class="passenger_input_field"/></div>
                        </div>
                        <div class="gender_section">
                            <div class="gender_box">
                                <select name="gender[]" class="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="male">MALE</option>
                                    <option value="female">FEMALE</option>
                                </select>
                            </div>
                            <div class="passenger_type radio-group">
                                <div class="passenger_options">
                                    <label for="adult">Adult</label>
                                    <input type="checkbox" name="passenger_option[]" value="adult" id="adult"  />
                                </div>
                                <div class="passenger_options">
                                    <label for="children">Children</label>
                                    <input type="checkbox" name="passenger_option[]" value="children" id="children" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="passenger_details_form_input">

                </div>

            </div>

            <div class="passenger_seat_tracker_box">
                <div class="passenger_seat_picker_header">
                    <div><span>Choose Seat(s)</span></div>
                    <div><img src="{{asset('/images/icons/seat.png')}}"/></div>
                </div>
                <div class="seat_selector_indicator">
                    <div>
                        <div class="selected_indicator"></div>
                    </div>
                    <div>
                        <h5>Selected</h5>
                    </div>
                    <div>
                        <div class="booked_indicator"></div>
                    </div>
                    <div>
                        <h5>Booked</h5>
                    </div>
                    <div>
                        <div class="available_indicator"></div>
                    </div>
                    <div>
                        <h5>Available</h5>
                    </div>
                </div>
                <div class="passenger_selector_box">

                    @foreach($fetchSeats as $seat)
                      <div class="passenger_seat_picker_bpdy">

                          <a href="{{$seat->id}}"   @if($seat->booked_status == 0)  class="available seat_selector btn"
                                  @elseif($seat->booked_status == 1) class="seat_selector available_indicator btn"
                                  @elseif($seat->booked_status == 2) class="booked seat_selector btn"  @endif
                                 >
                              {{$seat->seat_position}}</a>

                      </div>
                    @endforeach
                  </div>
            </div>
        </div>
        <div class="continue_to_payment">
            <button class="make_payment" >CONTINUE TO PAYMENT</button>
        </div>
        </form>
    </div>

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
                    var user_id = {{auth()->user()->id}}
                    var  baseUrl = {{APP_ENV('APP_URL')}}

                $.ajax({
                    type:'POST',
                    url:  baseUrl + "/seat-selector-tracker/",
                    data:{"_token": "{{ csrf_token() }}",seat_id:id , user_id },
                    success:function(data){
                        if(data.success)
                        {
                           console.log('worked')
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
                var  baseUrl = {{APP_ENV('APP_URL')}}
                $.ajax({
                    type:'POST',
                    url:baseUrl +  "/deselect-seat/",
                    data:{"_token": "{{ csrf_token() }}",seat_id:id , user_id },
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
            $('.passenger_details_form_input').append(`<div >
                        <div class="form-group passenger_name">
                            <div><label>FULL NAME</label></div>
                            <div><input type="text" name="full_name[]"  class="passenger_input_field fullname"/></div>
                        </div>
                        <div class="gender_section">
                            <div class="gender_box">
                                <select name="gender[]" class="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="male">MALE</option>
                                    <option value="female">FEMALE</option>
                                </select>
                            </div>
                            <div class="passenger_type radio-group">
                                <div class="passenger_options">
                                    <label for="adult">Adult</label>
                                    <input type="checkbox" name="passenger_option[]" value="adult" id="adult" />
                                </div>
                                <div class="passenger_options">
                                    <label for="children">Children</label>
                                    <input type="checkbox" name="passenger_option[]" value="children" id="children" />
                                </div>
                            </div>
                        </div>
                    </div>`);
        });
        function displayErrorMessage(message) {
            toastr.error(message, 'Error');
        }

    </script>
@endsection
