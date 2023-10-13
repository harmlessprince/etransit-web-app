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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .mySlides {
        display: none
    }

    .w3-left, .w3-right, .w3-badge {
        cursor: pointer
    }

    .w3-badge {
        height: 13px;
        width: 13px;
        padding: 0
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Schedule Information</h4>
                        <br>
                        <h6>PickUp Address: {{$schedule->pick_up_address }}</h6>
                        <hr>
                        <h6>Drop Offs: {{implode(",",$schedule->routes ?? ["N/A"]) ?? "N/A"}}</h6>
                        <hr>
                        <h6>PickUp City: {{$schedule->pickup ? $schedule->pickup->location : "--" }}</h6>
                        <hr>
                        <h6>Destination City : {{$schedule->destination ? $schedule->destination->location : "--"}}</h6>
                        <hr>
                        <h6>Departure Date : {{$schedule->departure_date->format('Y-M-d')}}</h6>
                        <hr>
                        <h6>Departure Time : {{$schedule->departure_time}}</h6>
                        @if(!is_null($schedule->return_date))
                            <hr>
                            <h6>Return Date : {{$schedule->return_date->format('Y-M-d')}}</h6>
                        @endif
                        <hr>
                        <h6>Seats Available :{{$schedule->seats_available}} </h6>
                        <hr>
                        <h6>Bus Registration : {{$schedule->bus ? $schedule->bus->bus_registration : " "}}</h6>
                        <hr>
                        <h6>Bus Model : {{$schedule->bus ? $schedule->bus->bus_model : " "}}</h6>
                        <hr>
                        <h6>Bus Type : {{$schedule->bus ? $schedule->bus->bus_type : " "}}</h6>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Bus Pictures</h4>
                        <br>
                        @isset($schedule->bus->bus_pictures)
                            <div class="w3-content w3-display-container" style="max-width:800px">
                                @foreach($schedule->bus->bus_pictures as $picture)
                                    <img class="mySlides" src="{{ $picture }}" alt="" style="width:100%;">
                                @endforeach

                                <div class="w3-row-padding w3-section">
                                    @foreach($schedule->bus->bus_pictures as $key=>$picture)
                                        <div class="w3-col s4">
                                            <img class="demo w3-opacity" src="{{ $picture }}" alt=""
                                                 style="width:100%;" onclick="currentDiv({{ $key+1 }})">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endisset
                        @if(!$schedule->bus->bus_pictures)
                            <h2>No Picture Available</h2>
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
    <script>
        function currentDiv(n) {
            showDivs(n);
        }

        function showDivs(n) {
            let slideIndex;
            let i;
            let x = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("demo");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
            }
            x[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " w3-opacity-off";
        }
    </script>

@endsection
