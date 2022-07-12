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

    <div class="card">
        <div class="card-body">
           <h5>Partner Driver</h5>
            <hr>
            <h6>Full Name : {{$driver->full_name}}</h6>
            <hr>
            <h6>Years of Experience : {{$driver->experience}}</h6>
            <hr>
            <h6>Email : {{$driver->email}}</h6>
            <hr>
            <h6>Phone Number : {{$driver->phone_number}}</h6>
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
        <diV style="test-align: center;">
            <h6>Daily Rate</h6>
            <div class="fs-3">
                @if($driver->daily_rate)
                  &#8358;{{$driver->daily_rate}}
                @else
                   No Rate Set
                @endif
            </div>
        </diV>
        </div>
        <div class="card-footer">
            <div>
                <a href="#" class="btn btn-secondary">Edit Profile</a>
                @if(!$driver->self_managed)
                <a data-toggle="modal" data-target="#editRateModal" class="btn btn-primary"> Set Daily Rate</a>
                <br><br>
                @endif
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="editRateModal" tabindex="-1" role="dialog" aria-labelledby="editRateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"> Set Daily Rate</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST"  action="{{route('admin.set-drivers-rate')}}">
                @csrf
                <input hidden value="{{$driver->id}}" name="id">
                <div class="modal-body">
                    <br>
                    <div class="form-group">
                        <label for="rate">Daily Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="send-btn  btn-submit" id="send-btn">Set Rate</button>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection
