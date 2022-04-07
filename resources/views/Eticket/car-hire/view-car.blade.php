@extends('Eticket.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }

    input:focus{
        outline:none !important;
    }
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    .add_bus_btn{
        display: flex;
        justify-content: flex-end;
    }
    .space-left{
        margin-left: 10px;
        margin-bottom:10px;
    }
    a{
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
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">View Car</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('e-ticket/view-tenant-car-history/'.$car->id)}}">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$carHistories}}</h1>
                            <h6>Trip Histories</h6>
                        </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>&#x20A6; {{number_format($transactionSum) }}</h1>
                            <h6>Transaction(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Car Information</h5>
                        <hr>
                        <h6>Car Name : {{$car->car_name}}</h6>
                        <hr>
                        <h6>Car Registration : {{$car->car_registration}}</h6>
                        <hr>
                        <h6>Car Class : {{Ucfirst($car->carclass->name)}}</h6>
                        <hr>
                        <h6>Car Type : {{Ucfirst($car->cartype->name)}}</h6>
                        <hr>
                        <h6>Car Transmission : {{$car->transmission}}</h6>
                        <hr>
                        <h6>Car Model : {{$car->model_year}}</h6>
                        <hr>
                        <h6>Capacity : {{$car->capacity}}</h6>
                        <hr>
                        <h6>Currently Booked : {{$car->booked_status == 'false' ? 'Not Booked' : 'Booked'}}</h6>
                        <hr>
                        <h6>Extra Hour : {{$carPlans[0]->extra_hour}}</h6>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Car Plan</h5>
                        @foreach($carPlans as $plan)
                        <hr>
                            <h6>{{$plan->plan}} : {{$plan->amount}}</h6>
                        <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
