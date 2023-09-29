@extends('Eticket.layout.app')
<style>
    input, select {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;

    }


    input:focus {
        outline: none !important;
    }

    .align-text {
        text-align: center;
    }

    .three-row-grid {
        display: flex;
        justify-content: space-between;
    }

    .add_bus_btn {
        display: flex;
        justify-content: flex-end;
    }

    .space-left {
        margin-left: 10px;
        margin-bottom: 10px;
    }

    a {
        text-decoration: none !important;
    }

    .add_more_images_text {
        color: red;
    }

    .sumbit_request {
        color: #fff !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Add Car</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
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
        <div class="col-md-3 colm-sm-3 col-lg-3 col-xl-3 col-xs-3"></div>
        <div class="col-md-6 colm-sm-6 col-lg-6 col-xl-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{url('/e-ticket/update-car-plan/'.$carId)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="car-box">
                            <div class="row">
                                @foreach($carplans as $plan)
                                    <div class="col-md-12 colm-sm-12 col-lg-12 col-xl-12 col-xs-12">
                                        <div class="form-group">
                                            <label id="plan">{{$plan->plan}}</label>
                                            <input type="text" name="{{$plan->plan}}" id="plan" class="form-control"
                                                   value="{{ $plan->amount }}" required/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <button class="sumbit_request btn btn-success" type="submit">Update Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
