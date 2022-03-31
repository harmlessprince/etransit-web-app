
@extends('layouts.app')
<style>
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
</style>
@section('content')
<section style="padding-left: 0px;background: var(--bs-gray-100);">
    <form method="POST" action="{{url('add-passenger-seat')}}" id="form_submit">
        @csrf
        <input type="hidden" value="{{$tripType}}" name="tripType" id="tripType" />
        <input type="hidden" value="{{$ferry_trip_id}}" name="ferry_trip_id"  />


    <div class="container">
        <div class="row">
            <div class="col-sm-6" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);">
                <div class="row passenegr_header">
                    <div class="col">
                        <h5>PASSANGER DETAILS
                            <div class="add_more_passeneger_icon">
                                <button id="buttonID"> <img src="{{asset('images/icons/add_user_2.png')}}"  width="20" height="20" /> Add More Passenger</button>
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
                                    <div><input type="text" name="next_of_kin_name[]"  class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                </div>
                                <div class="form-group passenger_name">
                                    <div><label class="form-label" style="font-size: 14px;margin-top:15px;color:  var(--bs-gray-500);">NEXT OF KIN NUMBER</label></div>
                                    <div><input type="text" name="next_of_kin_number[]" class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                </div>
                            </div>

                            <div class="passenger_details_form_input">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" id="secondtab" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;margin-top: 0px;">
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
                <div class="row" style="margin-top: 53px;padding: 24px;box-shadow: 1px 1px 6px rgb(231,231,231);border-left-width: 1px;border-radius: 20px;width: 252px;margin-left: 13px;">
                    <div class="col-12">
                        <h6 style="color: var(--bs-gray);"></h6>
                    </div>
                    <div class="col">
                        <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                            @foreach($seats as $index => $seat)
                            <div class="col-3">
                                <a  href="{{$seat->id}}"
                                   @if($seat->booked_status == 0)     class="available seat_selector btn seat_picker_new"
                                   @elseif($seat->booked_status == 1) class="seat_selector available_indicator btn seat_picker_new"
                                   @elseif($seat->booked_status == 2) class="booked seat_selector btn seat_picker_new"  @endif
                                   style="margin-top: 0px;margin-bottom: 10px;margin-right: 0px;margin-left: 0px;width: 33px;color: var(--bs-gray);border-color: #c5c5c5;border-left-color: #c5c5c5;background: rgba(13,110,253,0);font-size: 11px;padding-left: 10px;">
                                    <strong>{{Ucfirst($seat->ferryseat->coach_type) . $seat->ferryseat->coach_number }} </strong>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <h6 style="color: var(--bs-gray);"></h6>
                    </div>
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
        var user_id = {{auth()->user()->id}}
        var trip_type = $("input[name='tripType']").val();

        $.ajax({
            type:'POST',
            url: "{{ route('select-ferry-seat') }}",
            data:{"_token": "{{ csrf_token() }}",seat_id:id , user_id ,trip_type},
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


        $.ajax({
            type:'POST',
            url:  "{{ route('de-select-ferry-seat') }}",
            data:{"_token": "{{ csrf_token() }}",seat_id:id , user_id ,trip_type },
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
                                                    <input class="form-check-input" type="checkbox" value="adult" name="passenger_option[]" id="formCheck-1">
                                                    <label class="form-check-label" for="formCheck-1" style="font-size: 14px;">&nbsp; Adult</label>
                                                </div>
                                                <div class="form-check d-inline-flex" style="margin-left: 18px;">
                                                    <input class="form-check-input" type="checkbox" value="children" name="passenger_option[]" id="formCheck-2">
                                                    <label class="form-check-label" for="formCheck-2" style="font-size: 14px;">&nbsp; Child</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group passenger_name">
                                    <div><label class="form-label" style="font-size: 14px; margin-top:15px; color: var(--bs-gray-500);">NEXT OF KIN FULL NAME</label></div>
                                    <div><input type="text" name="next_of_kin_name[]"  class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
                                </div>
                                <div class="form-group passenger_name">
                                    <div><label class="form-label" style="font-size: 14px; margin-top:15px; color: var(--bs-gray-500);">NEXT OF KIN NUMBER</label></div>
                                    <div><input type="text" name="next_of_kin_number[]" class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/></div>
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
