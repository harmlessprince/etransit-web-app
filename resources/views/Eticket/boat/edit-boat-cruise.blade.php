@extends('Eticket.layout.app')



@section('content')
    <div class="container-fluid">
    @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Edit Boat Cruise</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>

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
        <div class="card">
            <div class="card-body">
                <form action="{{url('e-ticket/update-boat-trip/'.$boatTrip->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$boatTrip->boat_id}}" name="boat_id" id="boatId"/>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="cruise_name" value="{{$boatTrip->cruise_name}}" class="form-control" id="cruise_name" required/>
                    </div>

                    <div class="form-group">
                        <label for="amount_min">Amount (min)</label>
                        <input type="text" name="amount_min" value="{{$boatTrip->min_amount}}" id="amount_min" class="form-control" required/>
                    </div>

                    <div class="form-group">
                        <label for="amount_max">Amount (Max)</label>
                        <input type="text" name="amount_max" class="form-control" value="{{$boatTrip->max_amount}}" id="amount_max" required/>
                    </div>
                    <div class="form-group">
                        <label for="date">Departure Date</label>
                        <input type="date" name="departure_date" class="form-control" value="{{$boatTrip->departure_date}}" id="date"/>
                    </div>
                    <div class="form-group">
                        <label for="time">Departure Time</label>
                        <input type="time" name="time" class="form-control" value="{{$boatTrip->departure_time}}" id="time"/>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration {Number Of Days) </label>
                        <input type="number" name="duration" class="form-control" value="{{$boatTrip->duration}}" id="duration" required/>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destination</label>
                       <select class="form-control" id="destination" name="destination">
                           <option value=""> select Location </option>
                           @foreach($locations as $location)
                           <option value="{{$location->id}}">{{$location->destination}}</option>
                           @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Cruise Description</label>
                        <textarea class="ckeditor form-control" rows="10" cols="20" id="description" name="description">{{$boatTrip->description}}</textarea>
                    </div>
                    <input type="submit" value="Save Changes" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>


@endsection    