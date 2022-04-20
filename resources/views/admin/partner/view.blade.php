@extends('admin.layout.app')
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

        </div>
    </div>

</div>


@endsection
