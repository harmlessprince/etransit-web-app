@extends('admin.layout.app')
<style>
    .button-box{
        display:flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .bulk-upload-button , .add-terminal-button{
        background: #021037 !important;
        cursor: pointer;
        opacity: 0.8 !important;
        border: 1px solid  #021037 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
    }
    .bulk-upload-button:hover , .add-terminal-button:hover{
        background: #DC6513 !important;
        opacity: 0.8 !important;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
        cursor: pointer;
    }
    .checkbox_box{
        display:flex;
        justify-content: space-between;
    }
    #editModal{

        height: 700px !important;
    }

    .send-btn{
        background: #021037;
        color:white !important;
        padding:10px;
        border-radius:2px;
        border:1px solid #021037;
    }
    .send-btn:hover{
        background: #DC6513;
        color:white !important;
        padding:8px;
        border-radius:2px;
        border:1px solid #DC6513;

    }
    .btn-close{
        background:#e70c0c;
        /*#021037;*/
        color:white !important;
        padding:10px;
        border-radius:2px;
        border:1px solid #e70c0c;
    }
    .btn-close:hover{
        padding:8px;
    }

</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Schedule Ferry Event</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="button-box" >
{{--            <a href="{{url('/admin/import-export-schedule')}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">Bulk Import Event</a>&nbsp;--}}
{{--            <button class="btn s add-terminal-button btn-sm"  data-toggle="modal" data-target="#vehicleModal">View Schedule Event</button>--}}
            <a href="{{url('/admin/view-ferry-schedules/'.$ferry->id)}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">View Schedule Event</a>&nbsp;
        </div>
        <div class="card ">
            <div class="card-body">
                <div style="display: flex; justify-content: center;">
{{--                    <h1>{{strtoupper($bus->car_type)}}  - {{strtoupper($bus->car_registration)}}</h1>--}}
                </div>
            </div>
        </div>
        <div class="card ">
            <div class="card-body">
                <div id="app">
                    <div id='schedule_event_calender'></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modalBody" role="document" >
            <div class="modal-content">
                <div class="modal-body">
                    <h3>Schedule Events</h3>
                    <br>
                    <input type="hidden" value="{{$ferry->id}}" name="ferry_id" id="ferryId"/>
                    <div class="form-group">
                        <label for="pick_up">Pick Up</label>
                        <select class="form-control" name="pickup" id="pick_up">
                            <option> Please Select Pick Up Station </option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" >{{$location->locations}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pick_up">Destination</label>
                        <select class="form-control" name="destination" id="destination">
                            <option> Please Select Destination </option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" >{{$location->locations}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departure_time">Departure Time</label>
                        <input type="time" name="departure_time" id="departure_time" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="trip_duration">Trip Duration</label>
                        <input type="number" name="trip_duration" id="trip_duration" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label for="t_fare">Transportation Fee (Adult)</label>
                        <input type="text" name="t_fare" class="form-control" id="Tfare" required/>
                    </div>

                    <div class="form-group">
                        <label for="t_fare_child">Transportation Fee (Child)</label>
                        <input type="text" name="t_fare_child" class="form-control" id="TfareChild" required/>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                       <textarea class="ckeditor form-control" id="description" cols="10" rows="10" ></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-close" data-dismiss="modal">Close</button>
                    <input type="button" class="send-btn btn-submit" id="appointment_update" value="Save">
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            var SITEURL = "{{ url('/admin') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#schedule_event_calender').fullCalendar({
                editable: true,
                editable: true,
                events: SITEURL + "/event/ferry/" + {{$ferry->id}} +"/schedule",
                displayEventTime: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (event_start, event_end, allDay ) {
                    var modalOpen = $("#editModal").modal('show');

                    if (modalOpen) {
                        var event_start  = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                        $(".btn-submit").click(function(e){
                            var ferryId           = $("input[name=ferry_id]").val();
                            var departureTime     = $("input[name=departure_time]").val();
                            var Tfare             = $("input[name=t_fare]").val();
                            var TfareChild        = $("input[name=t_fare_child]").val();
                            // var description       = $("#description").val();
                            var description        = CKEDITOR.instances['description'].getData();
                            var pickUp            =  $("#pick_up").val();
                            var destination       = $("#destination").val();
                            var duration          = $("input[name=trip_duration]").val();

                            $.ajax({
                                url: SITEURL + '/schedule/ferry-event',
                                data: {
                                    ferryId,
                                    departureTime,
                                    Tfare,
                                    pickUp,
                                    destination,
                                    event_start,
                                    TfareChild,
                                    description,
                                    duration,
                                },
                                type: "POST",
                                success: function (response) {
                                    console.log(response)
                                    if(response.success){
                                        displaySuccessMessage(response.message);
                                    }else{
                                        displayErrorMessage(response.message);
                                    }
                                    setTimeout(function(){ location.reload(); }, 3000);
                                },
                                error: function(xhr, textStatus, error){
                                    displayErrorMessage("An error occured");
                                }
                            });

                        });
                    }
                },
            });
        });

        function displaySuccessMessage(message) {
            toastr.success(message, 'Successful');
        }

        function displayErrorMessage(message) {
            toastr.error(message, 'Error');
        }
    </script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>

@endsection
