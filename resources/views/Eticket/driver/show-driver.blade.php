@extends('Eticket.layout.app')
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
                    <h3>Driver's Details</h3>
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
                        <h4>Driver Information</h4>
                        <br>
                        <h6>Full Name : {{$driver->full_name}}</h6>
                        <hr>
                        <h6>Address : {{$driver->address}}</h6>
                        <hr>
                        <h6>Phone Number : {{$driver->phone_number}}</h6>
                        <hr>
                        <h6>NIN : {{$driver->nin}}</h6>
                        <hr>
                        <button type="button" class="edit btn btn-info" data-toggle="modal" data-target="#picture">
                           View  Driver's Picture
                        </button>
                        <button type="button" class="edit btn btn-info" data-toggle="modal" data-target="#license">
                           View Driver's License
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Guarantors Information</h4>
                        <br>
                        <h6>Guarantor Full Name : {{$driver->guarantor_name}}</h6>
                        <hr>
                        <h6>Guarantor Address : {{$driver->guarantor_name}}</h6>
                        <hr>
                        <h6>Guarantor Phone Number : {{$driver->guarantor_name}}</h6>
                        <hr>
                        <button type="button" class="edit btn btn-info" data-toggle="modal" data-target="#guarantor_picture">
                            View Guarantor's Picture
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="modal fade" id="guarantor_picture" tabindex="-1" role="dialog" aria-labelledby="guarantor_picture" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Guarantor's Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if($driver->guarantor_picture)
                                <img class="" src="{{ $driver->guarantor_picture }}" alt="" style="width:100%;">
                            @else
                                <h4>No Picture Uploaded</h4>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="picture" tabindex="-1" role="dialog" aria-labelledby="picture" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Driver's Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($driver->picture)
                                <img class="" src="{{ $driver->picture }}" alt="" style="width:100%;">
                            @else
                                <h4>No Picture Uploaded</h4>
                            @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="license" tabindex="-1" role="dialog" aria-labelledby="license" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Driver's License</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($driver->license)
                                <img class="" src="{{ $driver->license }}" alt="" style="width:100%;">
                            @else
                                <h4>No Picture Uploaded</h4>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
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
