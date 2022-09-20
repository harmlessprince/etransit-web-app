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
                        <li class="breadcrumb-item">Tracking Console</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
              <form action="{{url('admin/all/tracking')}}">
                  @csrf
                  <div style="display: flex;">
                      <div class="form-group col-md-4 col-sm-4 col-lg-4 col-xl-4">
                          <label>Tracking ID</label>
                          <input type="text" class="form-control" name="tracking_id"/>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-4 col-xl-4">
                          <label>Tracking Status</label>
                          <select class="form-control" name="tracking_status">
                              <option value="">Select Status</option>
                              <option value="active">Active</option>
                              <option value="inactive">In active</option>
                          </select>
                      </div>
                      <div class="form-group col-md-4 col-sm-4 col-lg-4 col-xl-4">
                          <label>Tracking Type</label>
                          <select class="form-control" name="tracking_type">
                              <option value="">Select Tracking Type</option>
                              <option value="standalone">Standalone</option>
                              <option value="bus_booking">Bus Booking</option>
                              <option value="car_hiring">Car Hiring</option>
                              <option value="train_service">Train Service</option>
                              <option value="ferry_service">Ferry Service</option>
                              <option value="boat_service">Boat Service</option>
                              <option value="tour_service">Tour Service</option>
                              <option value="parcel_service">Parcel Service</option>
                          </select>
                      </div>
                  </div>
                  <div style="display: flex;justify-content: center;">
                      <button class="btn btn-success btn-sm" type="submit" style="color:white;">Filter Tracking</button>
                      &nbsp;&nbsp;
                      <a class="btn btn-danger btn-sm" href="{{url('admin/all/tracking')}}" style="color:white;">Reset Filter</a>
                  </div>
              </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @foreach($trackers as $tracker)
                    <div class="card">
                        <div class="card-body">
                            <h6>{{$tracker->user->full_name}} <span @if($tracker->status == 'active') class="text-success" @else class="text-danger"@endif>{{strtolower($tracker->status)}}</span></h6>
                            <p>{{$tracker->tracking_type}}</p>
                            <p>{{$tracker->id}}</p>
                            <p>{{$tracker->created_at->diffforhumans()}}</p>
                            <p><a href="{{url('admin/view-tracking/'.$tracker->id)}}" class="btn btn-success btn-sm">View Tracking Records</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{$trackers->links()}}
    </div>

@endsection
