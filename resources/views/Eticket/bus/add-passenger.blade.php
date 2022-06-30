@extends('Eticket.layout.app')
<style>
    #second
    .passsneger_details_header_text{
        display:grid;
        grid-template-columns: repeat(4 , 1fr);
    }

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
    .seat-select-box{
        float : right;
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
@toastr_css



    <h1 style="color: var(--bs-white);text-align: center;"><strong>Add Passengers</strong></h1>
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
          <form method="POST" action="{{url('e-ticket/add-passengers/'.$schedule_id .'/'. $tripType)}}" id="form_submit">
            @csrf
            <input type="hidden" value="1" name="tripType" id="tripType" />
            <div class="container w-50" style="float: left">
                <div class="row">
                    <div class="col"
                        style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);">
                        <div class="row passenegr_header">
                            <div class="col">
                                <h5>PASSENGER DETAILS
                                    <div class="add_more_passeneger_icon">
                                        <button id="buttonID"> <img src="{{asset('images/icons/add_user_2.png')}}" width="20"
                                                height="20" /> Add More Passenger</button>
                                    </div>
                                </h5>
                            </div>

                        </div>
                        <div class="row">
                           <div>

                                <div class="row">
                                    <div class="col" style="margin-top: 44px;">
                                        <h6>PASSENGER # 1 DETAILS</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div style="margin-top: 28px;">
                                        <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">FULL
                                            NAME</label>
                                        <input class="form-control" name="full_name[]" type="text"
                                            style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 1px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"
                                            required>
                                    </div>
                                </div>
                                <div style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">EMAIL</label>
                                    <input class="form-control" name="email[]" type="email"
                                        style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
                            <div style="margin-top: 28px;">
                                <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">PHONE
                                    NUMBER</label>
                                <input class="form-control" name="phone[]" type="text"
                                    style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"
                                    required>
                            </div>
                        </div>
                        <div>
                            <div class="col">
                                <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">GENDER</label>
                                <select class="form-select" name="gender[]"
                                    style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;background: rgba(255,255,255,0);"
                                    required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col d-block">
                                <div class="row d-md-flex">
                                    <div class="col-md-4"><label class="col-form-label"
                                            style="font-size: 14px;color: var(--bs-gray-500);">AGE GROUP</label></div>
                                    <div class="col-md-8 d-inline-flex" style="padding-right: 0px;padding-left: 5px;">
                                        <div class="form-check d-inline-flex" style="margin-left: 1px;">
                                            <input class="form-check-input" name="passenger_option[]" value="adult"
                                                type="radio" id="formCheck-1">
                                            <label class="form-check-label" for="formCheck-1"
                                                style="font-size: 14px;">&nbsp;Adult</label>
                                        </div>
                                        <div class="form-check d-inline-flex" style="margin-left: 18px;">
                                            <input class="form-check-input" name="passenger_option[]" value="children"
                                                type="radio" id="formCheck-2">
                                            <label class="form-check-label" for="formCheck-2" style="font-size: 14px;">&nbsp;
                                                Child</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group passenger_name">
                                <div><label class="form-label"
                                        style="font-size: 14px; margin-top:15px;color: var(--bs-gray-500);">NEXT OF KIN FULL
                                        NAME</label></div>
                                <div><input type="text" name="next_of_kin_name[]" class="form-control" type="text"
                                        style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" />
                                </div>
                            </div>
                            <div class="form-group passenger_name">
                                <div><label class="form-label"
                                        style="font-size: 14px;margin-top:15px;color:  var(--bs-gray-500);">NEXT OF KIN
                                        NUMBER</label></div>
                                <div>
                                    <input type="text" name="next_of_kin_number[]" class="form-control" type="text"
                                        style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" />
                                </div>
                            </div>
                        </div>

                        <div class="passenger_details_form_input">
                        </div>

                </div>
               </div>
            </div>
        <div  id="seat-select-box"
            style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;margin-top: 0px;padding-left: 90px;padding-right: 30px;">
            <div class="row">
                <div class="col-md-12" style="text-align: left;padding-left: 5px;">
                    <p style="font-weight: bold;">Choose Seats&nbsp;<i class="material-icons"
                            style="margin-top: 2px;padding-top: 3px;color: rgb(42,66,136);"></i></p>
                </div>
                <div class="col-md-12 d-inline-flex flex-row">
                    <div class="form-check" style="padding-left: 15px;"><input class="form-check-input" type="checkbox"
                            id="formCheck-7" style="color: rgb(52,63,95);background: rgb(52,63,95);"><label
                            class="form-check-label" for="formCheck-7">Selected</label></div>
                    <div class="form-check" style="padding-left: 40px;"><input class="form-check-input" type="checkbox"
                            id="formCheck-8" style="background: var(--bs-gray-400);"><label class="form-check-label"
                            for="formCheck-8">Booked</label></div>
                    <div class="form-check" style="padding-left: 40px;"><input class="form-check-input" type="checkbox"
                            id="formCheck-9"><label class="form-check-label" for="formCheck-9">Available</label></div>
                </div>
            </div>
            <div class="row"
                style="margin-top: 53px;padding: 24px;box-shadow: 1px 1px 6px rgb(231,231,231);border-left-width: 1px;border-radius: 20px;width: 252px;margin-left: 13px;">
                @foreach($fetchSeats as $seat)
                <div class="col-4">
                    <div class="row">
                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center"
                            style="margin-top: 10px;margin-bottom: 10px;"></div>
                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center"
                            style="margin-top: 10px;margin-bottom: 10px;"></div>
                        <div class="col-4 d-md-flex justify-content-md-center align-items-md-center"
                            style="margin-top: 10px;margin-bottom: 10px;">
                            <a href="{{$seat->id}}" @if($seat->booked_status == 0) class="available seat_selector btn
                                seat_picker_new"
                                @elseif($seat->booked_status == 1) class="seat_selector available_indicator btn seat_picker_new"
                                @elseif($seat->booked_status == 2) class="booked seat_selector btn seat_picker_new" @endif
                                style="width:43.25px;">{{$seat->seat_position}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-12 d-md-flex justify-content-center align-items-center align-content-center align-self-center justify-content-md-center"
                style="text-align: center;margin-top: 14px;padding-bottom: 17px;"><button class="btn btn-primary" type="submit"
                    style="width: 235.422px;background: rgb(52,63,95);">CONTINUE</button></div>
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
                    var t_id = {{session()->get('tenant_id')}};
                    var trip_type = $("input[name='tripType']").val();

                $.ajax({
                    type:'POST',
                    url: "{{ route('e-ticket.select-seat') }}",
                        //"/seat-selector-tracker/",
                    data:{"_token": "{{ csrf_token() }}",seat_id:id , tenant_id : t_id, trip_type : trip_type },
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

                var tenant_id = {{session()->get('tenant_id')}}
                var trip_type = $("input[name='tripType']").val();


                $.ajax({
                    type:'POST',
                    url:  "{{ route('e-ticket.deselect-seat') }}",
                    data:{"_token": "{{ csrf_token() }}",seat_id:id , tenant_id : t_id, trip_type : trip_type },
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
            $('.passenger_details_form_input').append(`
                                     <div class="row">
                                        <div class="col" style="margin-top: 28px;">
                                            <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">FULL NAME</label>
                                            <input class="form-control" name="full_name[]" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                            </div>
                                            <div class="col" style="margin-top: 28px;">
                                            <label class="form-label"  style="font-size: 14px;color: var(--bs-gray-500);">EMAIL</label>
                                            <input class="form-control" name="email[]" type="email" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                            </div>
                                        </div>
                                         <div class="col" style="margin-top: 28px;">
                                            <label class="form-label"  style="font-size: 14px;color: var(--bs-gray-500);">PHONE NUMBER</label>
                                            <input class="form-control" name="phone[]" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                            </div>
                                    </div>
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
                                            <div class="col-md-12"><label class="col-form-label" style="font-size: 14px;color: var(--bs-gray-500);">AGE GROUP</label>
                                                </div>
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
                                    <div><label class="form-label" style="font-size: 14px; margin-top:15px; color: var(--bs-gray-500);">NEXT OF KIN FULL NAME</label>
                                        </div>
                                    <div><input type="text" name="next_of_kin_name[]"  class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/>
                                        </div>
                                </div>
                                <div class="form-group passenger_name">
                                    <div><label class="form-label" style="font-size: 14px; margin-top:15px; color: var(--bs-gray-500);">NEXT OF KIN NUMBER</label></div>
                                    <div><input type="text" name="next_of_kin_number[]" class="form-control" type="text" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);"/>
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
