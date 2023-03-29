@extends('Eticket.layout.app')
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

        height: 600px !important;
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
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Schedule trip for {{strtoupper($boat->name)}}</li>
                    </ol>
                </div>
            </div>
        </div> 
    </div>    
    <div class="container-fluid">
        <div class="card ">
            <div class="card-body">
                <div id="app">
                    <div id='schedule_event_calender_boat'></div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modalBody" role="document" >
            <div class="modal-content">
                <div class="modal-body">
                    <h3>Schedule Events For Boat Cruise</h3>
                    <br>
                    <input type="hidden" value="{{$boat->id}}" name="boat_id" id="boatId"/>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="cruise_name" class="form-control" id="cruise_name" required/>
                    </div>

                    <div class="form-group">
                        <label for="amount_min">Amount (min)</label>
                        <input type="text" name="amount_min" id="amount_min" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label for="amount_max">Amount (Max)</label>
                        <input type="text" name="amount_max" class="form-control" id="amount_max" required/>
                    </div>

                    <div class="form-group">
                        <label for="time">Departure Time</label>
                        <input type="time" name="time" class="form-control" id="time" required/>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration {Number Of Days) </label>
                        <input type="number" name="duration" class="form-control" id="duration" required/>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination</label>
                       <select class="form-control" id="destination" name="destination">
                           <option value=""> select Location </option>
                           @foreach($locations as $location)
                           <option value="{{$location->id}}">{{$location->destination}}</option>
                           @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Cruise Description</label>
                        <textarea class="ckeditor form-control" rows="10" cols="20" id="description" name="description"></textarea>
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

            var SITEURL = "{{ url('/e-ticket') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#schedule_event_calender_boat').fullCalendar({
                editable: true,
                editable: true,

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
                            e.preventDefault()
                            var cruise_name        = $("input[name=cruise_name]").val();
                            var max_amount         = $("input[name=amount_max]").val();
                            var min_amount         = $("input[name=amount_min]").val();
                            var destination        = $("#destination").val();
                            // var description        = $("#description").val();
                            var description        = CKEDITOR.instances['description'].getData();
                            var time               = $("input[name=time]").val();
                            var boatID             = {{$boat->id}};
                            var duration           = $("input[name=duration]").val();

                            $.ajax({
                                url: SITEURL + '/post-scheduled-trip',
                                data: {
                                    cruise_name,
                                    max_amount,
                                    min_amount,
                                    destination,
                                    event_start,
                                    description,
                                    time ,
                                    boatID,
                                    duration
                                },
                                type: "POST",
                                success: function (response) {
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