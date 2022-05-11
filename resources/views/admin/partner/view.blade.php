@extends('admin.layout.app')
<style>
    h5{
        color:red;
    }
    .push_to_right{
        display: flex;
        justify-content: flex-end;
    }
</style>
@section('content')
<div class="container-fluid">
    @toastr_css
    <div class="page-header">
        <div class="row">
            <div class="col-6">
                <h3>{{env('APP_NAME')}}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Partners</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" >
    <div class="push_to_right">
       <div>
           <a href="{{url('admin/enable-partner-as-operator/'.$partner->id)}}" class="btn btn-danger"
              onclick="confirm('Are you sure you want to perform this operation ?')">
               Enable {{$partner->company_name}} As Operator
           </a>
           <br><br>
       </div>
    </div>
    <div class="card">
        <div class="card-body">
           <h5>Become Partners Information</h5>
            <hr>
            <h6>Full Name : {{$partner->full_name}}</h6>
            <hr>
            <h6>Company Name : {{$partner->company_name}}</h6>
            <hr>
            <h6>Email : {{$partner->email}}</h6>
            <hr>
            <h6>Phone Number : {{$partner->phone_number}}</h6>
            <hr>
            <h5>Services Needed</h5>
            @if(!is_null($partner->bus_service))
            <hr>
            <h6>Bus Services</h6>
            <hr>
            @endif
            @if(!is_null($partner->car_hire_service))
            <hr>
            <h6>Car Hire Services</h6>
            @endif

            @if(is_null($partner->car_hire_service) && is_null($partner->bus_service) )
            <hr>
            <h6>No Service Requested</h6>
            @endif
        </div>
    </div>

</div>


@endsection
