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
        align-items: center;
        padding:15px 17px;
        border-radius: 5px;
    }
    .selected{
        background:#7f7fd9;
        border : 1px solid #7f7fd9;
        width:60px;
        height:60px;
        color:black;
        align-items: center;
        padding:15px 17px;
        border-radius: 5px;
        color:white;
    }
    .booked{
        background: #ebebeb;
        border : 1px solid #ebebeb;
        width:60px;
        height:60px;
        color:black;
        align-items: center;
        padding:15px 17px;
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
                    <h3>{{\App\Models\Tenant::first()->company_name ?? env('APP_NAME')}}</h3>
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
                            <h3>No Driver Assigned yet to this bus.    <a href="{{url('e-ticket/assign-driver/'.$findSchedule->bus->id)}}" class="btn btn-danger">Assign Driver</a></h3>
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
                        <h6>PickUp City: {{$findSchedule->pickup->location}}</h6>
                        <hr>
                        <h6>Destination City : {{$findSchedule->destination->location}}</h6>
                        <hr>
                        <h6>Departure Date : {{$findSchedule->departure_date->format('Y-M-d')}}</h6>
                        <hr>
                        <h6>Departure Time : {{$findSchedule->departure_time}}</h6>
                        <hr>
                        <h6>Return Date : {{$findSchedule->return_date->format('Y-M-d')}}</h6>
                        <hr>
                        <h6>Seats Available :{{$findSchedule->seats_available}} </h6>
                        <hr>
                        <h6>Bus Registration : {{$findSchedule->bus->bus_registration}}</h6>
                        <hr>
                        <h6>Bus Model : {{$findSchedule->bus->bus_model}}</h6>
                        <hr>
                        <h6>Bus Type : {{$findSchedule->bus->bus_type}}</h6>
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
                            <div>
                                <a href="{{url('e-ticket/schedule-manifest/'.$findSchedule->id)}}" class="btn btn-success">Check Manifest</a>
                            </div>
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
                                <a href=""  @if($tracker->booked_status == 0)  class="available seat_picked"
                                     @elseif($tracker->booked_status == 1) class="selected seat_picked"
                                     @elseif($tracker->booked_status == 2) class="booked seat_picked"  @endif>{{$tracker->seat_position}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
    </script>
@endsection
