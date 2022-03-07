@extends('Eticket.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }

    input:focus{
        outline:none !important;
    }

    a{
        text-decoration: none !important;
    }
    .trip_box{
        background: greenyellow;
        color: gray;
        padding:5px;
        border-radius: 3px;
    }

    .trip_box_off{
        background: red;
        color: white;
        padding:5px;
        border-radius: 3px;
    }
</style>
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">View History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                   <hr>
                    <h5>User Information</h5>
                   <hr>
                    <h6>Full Name : {{$carHistory->user->full_name}}</h6>
                    <hr>
                    <h6>Email : {{$carHistory->user->email}}</h6>
                    <hr>
                    <h6>Phone Number : {{$carHistory->user->phone_number}}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
            @if(!is_null($carHistory->amount_to_remit_after_delayed_trip) && $carHistory->isReturned == 0)
                <div class="alert alert-danger" role="alert">
                    The car has been delayed for {{$carHistory->numbers_of_hours_delayed}} hour(s), user expected to pay extra sum of  &#x20A6; {{$carHistory->amount_to_remit_after_delayed_trip}} &nbsp; &nbsp;&nbsp; <a href="{{url('e-ticket/mark-as-paid/'.$carHistory->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to mark this as paid ?')">Mark As Paid</a>
                </div>
            @endif
        </div>
    </div>
    @if($carHistory->available_status == 'Off Trip')
    <span class="trip_box_off">{{$carHistory->available_status}}</span>
    @else
    <span class="trip_box">{{$carHistory->available_status}}</span>
    @endif
    <br/>
    <div class="row">
        <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <hr>
                    <h5>Car Details</h5>
                    <hr>
                    <h6>Car Name : {{$carHistory->car->car_name}}</h6>
                    <hr>
                    <h6>Car Registration : {{$carHistory->car->car_registration}}</h6>
                    <hr>
                    <h6>Model : {{$carHistory->car->model_year}}</h6>
{{--                    <h6><p id="demo"></p></h6>--}}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <hr>
                    <h5>Plan</h5>
                    <hr>
                    <h6>Plan : {{$carHistory->carplan->plan}}</h6>
                    <hr>
                    <h6>Amount : {{$carHistory->carplan->amount}}</h6>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <hr>
                    <h5>Pickup and Return Date Information</h5>
                    <hr>
                    <h6>Pick Up Date : {{$carHistory->date->format('Y F d')}}</h6>
                    <hr>
                    <h6>Pick Up Time  : {{$carHistory->time}}</h6>
                    <hr>
                    <h6>Expected Return Date : {{$carHistory->returnDate->format('Y F d')}}</h6>
                    <hr>
                    <h6>Expected Return Time  : {{$carHistory->returnTime->format('H:i:s')}}</h6>
                    <hr>
                    @if(!is_null($carHistory->dropOffDate))
                    <h6>Drop Off Date : {{$carHistory->dropOffDate->format('Y F d')}} </h6>
                    <hr>
                    <h6>Drop Off Time : {{$carHistory->drpOffTime}} </h6>
                    @endif
                    @if($carHistory->available_status == 'On Trip')
                    <h6><a href="{{url('e-ticket/confirm-drop-off/'.$carHistory->id)}}" class="btn btn-danger"  onclick="return confirm('Are you sure you want to confirm drop off ?')">Confirm Drop Off</a></h6>
                    @elseif($carHistory->available_status == 'Off Trip' && is_null($carHistory->dropOffDate))
                    <h6><a href="{{url('e-ticket/confirm-pick-up/'.$carHistory->id)}}" class="btn btn-success"  onclick="return confirm('Are you sure you want to confirm pick up ?')">Confirm Pick Up</a></h6>
                    @endif
                    <hr>
                    @if(!is_null($carHistory->numbers_of_hours_delayed))
                        <h6>Hours of Delay : {{$carHistory->numbers_of_hours_delayed}}</h6>
                        <hr>
                        <h6>Extra Pay : &#x20A6; {{$carHistory->amount_to_remit_after_delayed_trip}} </h6>
                        <hr>
                        <h6>Mark As Paid : &#x20A6; {{$carHistory->isReturned == 1 ? 'True' : 'False' }} </h6>
                    @endif

                </div>
            </div>
        </div>
    </div>
<script>
    // Set the date we're counting down to

    var countDownDate = new Date("Mar 21 2022 12:12:12").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
@endsection
