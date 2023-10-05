@extends('layouts.app')
<style>
    .func {
        background: green;
        color: white;
        padding: 4px;
        border-radius: 5px;
    }

    .not_func {
        background: red;
        color: white;
        padding: 4px;
        border-radius: 5px;
    }

    .align-text {
        text-align: center;
    }

    .three-row-grid {
        display: flex;
        justify-content: space-between;
    }

    .bus_event {
        display: flex;
        justify-content: flex-end;
    }

    .schedule_trip, .schedules, .assign_drivers {
        margin-left: 10px;
    }

    .assign_driver {
        display: flex;
        justify-content: center;
    }

    a:hover {
        text-decoration: none !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Vehicle</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
                                <h1>{{!is_null($findBus->driver) ? 1 : 0}}</h1>
                                <h6>Driver</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Bus Information</h4>
                        <br>
                        <h6>Bus Type : {{$findBus->bus_type}}</h6>
                        <hr>
                        <h6>Bus Model : {{$findBus->bus_model}}</h6>
                        <hr>
                        <h6>Bus Registration : {{$findBus->bus_registration}}</h6>
                        <hr>
                        <h6>Bus Wheels : {{$findBus->wheels}}</h6>
                        <hr>
                        <h6>Bus Passenger Seat : {{$findBus->seater}}</h6>
                        <hr>
                        <h6>Air Conditioning : @if($findBus->air_conditioning == 1 )
                                <span class="func"> Functional</span>
                            @else
                                <span class="not_func">Not Functional</span>
                            @endif</h6>
                        <hr>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4>Driver Information</h4>
                        <br>
                        @if(isset($findBus->driver))
                            <h6>Name : {{$findBus->driver->full_name}}</h6>
                            <hr>
                            <h6>Address : {{$findBus->driver->address}}</h6>
                            <hr>
                            <h6>Contact : {{$findBus->driver->phone_number}}</h6>

                        @endif
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

@endsection
