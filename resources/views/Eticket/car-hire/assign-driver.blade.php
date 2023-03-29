@extends('Eticket.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }

    input:focus{
        outline:none !important;
    }
    .optional_notes{
        color:red;
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
                        <li class="breadcrumb-item">Assign Driver To Car</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
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
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Assign Driver</h3>
                        <form action="{{url('e-ticket/assign-driver-car/'.$car->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="car_model">Car Name</label>
                                <input type="text" class="form-control" name="car_name" value="{{$car->car_name}}" id="car_model" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="bus_type">Bus Type</label>
                                <input type="text" class="form-control" name="bus_type" value="{{$car->cartype?$car->cartype->name:''}}" id="bus_type" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="registration">Car Registration</label>
                                <input type="text" class="form-control" name="car_registration" value="{{$car->car_registration}}" id="registration" disabled/>
                            </div>

                            <div class="form-group">
                                <label for="driver">Assign Driver</label><br>
                                <span class="optional_notes">Type in driver's phone number to assign them to the car</span>
                                <input type="text" class="form-control" name="driver_phone_number"value="{{old('driver_phone_number')}}" id="driver" />
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Assign Driver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
