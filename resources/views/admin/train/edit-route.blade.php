@extends('admin.layout.app')
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
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Update Train Route</li>
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
                        <form action="{{url('admin/update-train-route/'.$route->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="pickup_state">Pick Up State</label>
                                <select class="form-control" name="pickup_state" id="pickup_state">
                                    <option value="{{$route->city->id}}">{{$route->city->locations_state}}</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pickup_terminal">Pick Up Terminal</label>
                                <select class="form-control" name="pickup_terminal"  id="pickup_terminal" >
                                    <option value="{{$route->terminal->id}}">{{$route->terminal->stop_name}}</option>
                                    @foreach($trainRoutes as $dest_route)
                                        <option value="{{$dest_route->id}}">{{$dest_route->stop_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="destination_location">Destination State</label>
                                <select class="form-control" name="destination_location" id="destination_location">
                                    <option value="{{$route->destination->id}}">{{$route->destination->locations_state}}</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="destination_terminal">Destination Terminal</label>
                                <select class="form-control" name="destination_terminal" id="destination_terminal" >
                                    <option value="{{$route->destination_terminal->id}}">{{$route->destination_terminal->stop_name}}</option>
                                    @foreach($trainRoutes as $dest_route)
                                        <option value="{{$dest_route->id}}">{{$dest_route->stop_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="route_class">Route Class</label>
                                <select class="form-control" name="route_class" id="route_class" >
                                    <option value="{{$route->seatClass->id}}">{{$route->seatClass->class}}</option>
                                    @foreach($trainClass as $classT)
                                        <option value="{{$classT->id}}">{{$classT->class}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount_adult">Amount (adult)</label>
                                <input type="text" class="form-control" name="amount_adult" value="{{$route->amount_adult}}"  id="amount_adult"/>
                            </div>
                            <div class="form-group">
                                <label for="amount_child">Amount (Child)</label>
                                <input type="text" class="form-control" name="amount_child" value="{{$route->amount_child}}"  id="amount_child"/>
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
