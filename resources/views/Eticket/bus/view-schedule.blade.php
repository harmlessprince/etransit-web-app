@extends('Eticket.layout.app')
<style>

    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }

    .seat_box , .content_def{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        justify-items: center;
    }
    .content_def{
        margin-bottom: 20px;
    }

    .seat_picked{
        background: white;
        border : 1px solid black;
        margin-bottom: 20px;
        width:40px;
        height:40px;
        color:black;
        align-items: center;
        padding:10px 15px;
        border-radius: 5px;
    }

    .seat_picked_def_available{
        background: white;
        border : 1px solid black;
        width:40px;
        height:40px;
        color:black;
        align-items: center;
        padding:10px 15px;
        border-radius: 5px;
    }
    .seat_picked_def_booked{
        background: #ebebeb;
        border : 1px solid #ebebeb;
        width:40px;
        height:40px;
        color:black;
        align-items: center;
        padding:10px 15px;
        border-radius: 5px;
    }

    .seat_picked_def_picked{
        background:#7f7fd9;
        border : 1px solid #7f7fd9;
        width:40px;
        height:40px;
        color:black;
        align-items: center;
        padding:10px 15px;
        border-radius: 5px;
    }
    .seat_position_header{
        display: flex;
        justify-content: space-between;
    }
    .available{
        background: white;
        border : 1px solid black;
        width:60px;
        height:60px;
        color:black;
        text-align: center;
        border-radius: 5px;
    }
    .selected{
        background:#7f7fd9;
        border : 1px solid #7f7fd9;
        width:60px;
        height:60px;
        color:black;
        text-align: center;
        border-radius: 5px;
        color:white;
    }
    .booked{
        background: #ebebeb;
        border : 1px solid #ebebeb;
        width:60px;
        height:60px;
        color:black;
        text-align: center;
        border-radius: 5px;
    }
    .passenger-info{
        background: white;
        padding:10px;
        border: 1px solid #ebebeb;
        border-radius: 5px;
        z-index:10000;
    }


</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/buses')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Schedule</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="row three-row-grid">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if(isset($findSchedule->bus->driver))
                        <hr>
                        <h4>Driver Information</h4>
                        <hr>
                        <h6>Name:{{$findSchedule->bus->driver->full_name}} </h6>
                        <hr>
                        <h6>Address : {{$findSchedule->bus->driver->address}}</h6>
                        <hr>
                        <h6>Phone Number : {{$findSchedule->bus->driver->phone_number}} </h6>
                        <hr>
                        @else
                            <h3>No Driver Assigned yet to this Trip.
                                @if($findSchedule->bus)
                                <a href="{{url('e-ticket/assign-driver/'.$findSchedule->bus->id)}}" class="btn btn-danger">Assign Driver</a>
                                @else
                                --
                                @endif
                            </h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Schedule Information</h4>
                        <br>
                        <h6>PickUp Address: {{$findSchedule->pick_up_address }}</h6>
                        <hr>
                        <h6>Drop Offs: {{implode(",",$findSchedule->routes ?? ["N/A"]) ?? "N/A"}}</h6>
                        <hr>
                        <h6>PickUp City: {{$findSchedule->pickup ? $findSchedule->pickup->location : "--" }}</h6>
                        <hr>
                        <h6>Destination City : {{$findSchedule->destination ? $findSchedule->destination->location : "--"}}</h6>
                        <hr>
                        <h6>Departure Date : {{$findSchedule->departure_date->format('Y-M-d')}}</h6>
                        <hr>
                        <h6>Departure Time : {{$findSchedule->departure_time}}</h6>
                        @if(!is_null($findSchedule->return_date))
                        <hr>
                        <h6>Return Date : {{$findSchedule->return_date->format('Y-M-d')}}</h6>
                        @endif
                        <hr>
                        <h6>Seats Available :{{$findSchedule->seats_available}} </h6>
                        <hr>
                        <h6>Bus Registration : {{$findSchedule->bus ? $findSchedule->bus->bus_registration : " "}}</h6>
                        <hr>
                        <h6>Bus Model : {{$findSchedule->bus ? $findSchedule->bus->bus_model : " "}}</h6>
                        <hr>
                        <h6>Bus Type : {{$findSchedule->bus ? $findSchedule->bus->bus_type : " "}}</h6>
                        <hr>
                        <h6>Trip Status : {{Ucfirst($findSchedule->trip_status)}}</h6>
                        <hr>
                        <h6>Update Trip Schedule Status</h6>
                          <form action="{{url('e-ticket/update-schedule-status/'.$findSchedule->id)}}" method="POST">
                              @csrf
                              <select class="form-control" name="status">
                                  <option value="">Update Schedule Status</option>
                                  <option value="pending">Pending</option>
                                  <option value="trip in progress">Trip In Progress</option>
                                  <option value="canceled">Canceled</option>
                                  <option value="completed">Completed</option>
                              </select>
                              @if($errors->has('status'))
                                  <div class="error text-danger">{{ $errors->first('status') }}</div>
                              @endif
                              <br>
                              <button class="btn btn-success">Update Status</button>
                          </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <div class="seat_position_header">
                            <div>
                                <h4>Seat Information</h4>
                            </div>
                            <div style="margin-right:1em;">
                                <a href="{{url('e-ticket/add-passenger/'.$findSchedule->id)}}" class="btn btn-primary">Add Passengers</a>
                            </div>
                            <div  style="margin-right:1em;">
                                <a href="{{url('e-ticket/schedule-manifest/'.$findSchedule->id)}}" class="btn btn-success">Check Manifest</a>
                            </div>
                            @if(count($seatTracker) < 1)
                            <div  style="margin-right:1em;">
                                <a href="{{url('e-ticket/generate-schedule-empty-seat/'.$findSchedule->id)}}"
                                   onclick="alert('Are you sure you want to generate seat for this schedule?')"
                                   class="btn btn-danger">Generate Seat</a>
                            </div>
                            @endif

                        </div>
                        <hr>
                        <div class="center_item">
                            <div class="content_def">
                                <div>
                                    <div class="seat_picked_def_available"></div>
                                    <div><span>Available</span></div>
                                </div>
                               <div>
                                   <div class="seat_picked_def_booked"></div>
                                   <div><span>Booked</span></div>
                               </div>
                                <div>
                                    <div class="seat_picked_def_picked"></div>
                                    <div><span>Selected</span></div>
                                </div>
                            </div>
                            <hr>
                            <div class="seat_box">
                                @foreach($seatTracker as $tracker)
{{--                                    {{$tracker->id}}--}}
                                <a href="#"  @if($tracker->booked_status == 0)  class="available seat_picked"
                                     @elseif($tracker->booked_status == 1) class="selected seat_picked"
                                     @elseif($tracker->booked_status == 2) class="booked seat_picked"  @endif >{{$tracker->seat_position}}</a>
{{--                                    data-toggle="modal" data-target="#passengerDetails"--}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passengerDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Passenger Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="full_name">Name : <div id="name"></div></div>
                    <div class="booked_by">Booked By <div class="email"></div></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $.noConflict();

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('e-ticket.fetch-tenant-buses') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'car_type', name: 'car_type'},
                    {data: 'car_model', name: 'car_model'},
                    {data: 'car_registration', name: 'car_registration'},
                    {data: 'seater', name: 'seater'},
                    {data: 'wheels', name: 'wheels'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });
        });

        $(".seat_picked").click(function(e){
            var id = $(this).attr('href');
            console.log(id)

            $.ajax({
                url: 'e-ticket/fetch-passenger-details/'.id,
                data: { },
                type: "GET",
                success: function (response) {
                    // console.log(response)
                    if(response.success){
                    console.log(response)
                    }else{

                    }
                    setTimeout(function(){ location.reload(); }, 5000);
                },
                error: function(xhr, textStatus, error){
                    displayErrorMessage("An error occured");
                }
            });

        });
    </script>
@endsection
