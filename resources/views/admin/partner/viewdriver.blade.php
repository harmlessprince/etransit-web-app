@extends('admin.layout.app')
<style>
    h5{
        color:red;
    }
    img .documents{
        object-fit: contain;
        width: 80%;
        display: block
    }
    div .document-box{
        border-radius: 5px;
        padding: 10%;
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
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                   <h5>Prospective Driver</h5>
                    <hr>
                    <h6>Full Name : {{$driver->full_name}}</h6>
                    <hr>
                    <h6>Years of Experience : {{$driver->experience}}</h6>
                    <hr>
                    <h6>Email : {{$driver->email}}</h6>
                    <hr>
                    <h6>Phone Number : {{$driver->phone}}</h6>
                    <hr>
                    <hr>
                    <h6>Date of Birth : {{$driver->date_of_birth}}</h6>
                    <hr>
                    <h4> Addiitional Skills </h4>
                    @if($driver->convoy)
                    <h6>Convoy Driving</h6>
                    <p>Driver has experience or is trained in driving cars and SUVs in a secure convoy</p>
                    <hr>
                    @endif
                    @if($driver->light_commercial)
                    <hr>
                    <h6>Light Commercial Vehicles</h6>
                    <p> Driver is skilled in driving vehicles such as Hiace-class buses or 3 ton Vans</p>
                    @endif
                    @if($driver->commercial)
                    <hr>
                    <h6>Commercial Vehicles</h6>
                    <p> Driver is skilled in driving large passenger vehicles such as Coaster or Marco Polo buses</p>
                    @endif
                    @if($driver->trucks)
                    <hr>
                    <h6>Trucks</h6>
                    <p> Driver is skilled and experienced in driving Trucks (e.g Flatbeds, Articulated, Container e.t.c)</p>
                    @endif
                    @if($driver->industrial)
                    <hr>
                    <h6>Industrial/ Mobile Machinery</h6>
                    <p> Driver is skilled in driving vehicles such as Hiace-class buses or 3 ton Vans</p>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="push_to_right">
                        <div>
                            <a href="{{url('admin/partner/approve-driver/'.$driver->id)}}" class="btn btn-success"
                               onclick="confirm('Are you sure you want to perform this operation ?')">
                                Approve {{$driver->full_name}} As Driver
                            </a>
                            <br><br>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">

            <div class="row document-box">
            <h5>Utility Bill or NIN slip</h5>
              <img class="documents" src="{{$driver->utility_or_nin}}">
                <a class="btn btn-primary" href="{{$driver->utility_or_nin}}" target="_blank"><i class="far fa-search-plus"></i>View</a>
            </div>
            <div class="row document-box">
                <h5>Driver's Licence</h5>
                <img class="documents" src="{{$driver->license}}">
                <a class="btn btn-primary" href="{{$driver->license}}" target="_blank"><i class="far fa-search-plus"></i>View</a>
            </div>

        </div>
    </div>


</div>


@endsection
