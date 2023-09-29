@extends('Eticket.layout.app')
<style>
    input {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;

    }

    input:focus {
        outline: none !important;
    }

    .optional_notes {
        color: red;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Create Staff</li>
                    </ol>
                </div>
                <div class="col-6">

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
        @if(is_null($staff->termination_date))
            <div style="display: flex; justify-content: flex-end;">
                <a href="{{url('e-ticket/assign-role/'.$staff->id)}}" class="btn btn-success">Assign Role</a>
            </div>
        @endif
        <br>
        <div class="row">

            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-5">

                <div class="card">
                    <div class="card-body">
                        <h5>Staff Information</h5>
                        <hr>
                        <h6>Full Name: {{$staff->full_name}}</h6>
                        <hr>
                        <h6>Email : {{$staff->email}}</h6>
                        <hr>
                        <h6>Phone Number : {{$staff->phone_number}}</h6>
                        <hr>
                        <h6>Designation : {{$staff->designation}}</h6>
                        <hr>
                        <h6>Employment Date : {{$staff->employment_date->format('Y-M-d')}}</h6>
                        <hr>
                        @if(!is_null($staff->termination_date))
                            <h6>Termination Date : {{$staff->termination_date->format('Y-M-d')}}</h6>
                            <a href="{{url('e-ticket/enable/'.$staff->id.'/appointment')}}"
                               onclick="confirm('Do you wish to re-enable staff appointment ?');"
                               class="btn btn-success">Re-Enable Staff Appointment</a>
                        @else
                            <a href="{{url('e-ticket/terminate/'.$staff->id.'/appointment')}}"
                               onclick="confirm('Do you wish to terminate staff appointment ?');"
                               class="btn btn-danger">Terminate Staff Appointment</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-lg-7 col-xl-7">
                <div class="card">
                    <div class="card-body">
                        <h5>Address Information</h5>
                        <hr>
                        <h6>Address : {{$staff->address}}</h6>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
