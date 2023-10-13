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
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Schedule Bus</li>
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
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('e-ticket/add-schedule')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="bus_id">Bus </label>
                                <select class="form-control" name="bus_id" id="bus_id" required>
                                    @foreach($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->bus_registration }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="seats_available">Number of Seats Available</label>
                                <input type="number" class="form-control" name="seats_available"
                                       value="{{old('seats_available')}}"
                                       id="seats_available" required min="1"/>
                            </div>
                            <div class="form-group">
                                <label for="pick_up_address">Pick Up Address</label>
                                <input type="text" class="form-control" name="pick_up_address"
                                       value="{{old('pick_up_address')}}"
                                       id="pick_up_address" required/>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="terminal_id">Terminal </label>--}}
{{--                                <select class="form-control" name="terminal_id" id="terminal_id" required>--}}
{{--                                    @foreach($terminals as $terminal)--}}
{{--                                        <option value="{{ $terminal->id }}">{{ $terminal->terminal_name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="service_id">Service </label>--}}
{{--                                <select class="form-control" name="service_id" id="service_id" required>--}}
{{--                                    @foreach($services as $service)--}}
{{--                                        <option value="{{ $service->id }}">{{ $service->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="pickup_id">Pickup </label>
                                <select class="form-control" name="pickup_id" id="pickup_id" required>
                                    @foreach($pickups as $pickup)
                                        <option value="{{ $pickup->id }}">{{ $pickup->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="destination_id">Destination </label>
                                <select class="form-control" name="destination_id" id="destination_id" required>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="routes">Drop Offs (Add drop offs seperated by comma)</label>
                                <input type="text" class="form-control" name="routes"
                                       value="{{old('routes')}}"
                                       id="routes" required placeholder="lagos(Iyanapaja),ibadan(iwo road)"/>
                            </div>
                            <div class="form-group">
                                <label for="fare_adult">Adult Tfare</label>
                                <input type="number" class="form-control" name="fare_adult"
                                       value="{{old('fare_adult')}}"
                                       id="fare_adult" min="1" required/>
                            </div>
                            <div class="form-group">
                                <label for="fare_children">Child Tfare</label>
                                <input type="number" class="form-control" name="fare_children"
                                       value="{{old('fare_children')}}"
                                       id="fare_children" min="1" required/>
                            </div>
                            <div class="form-group">
                                <label for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" name="departure_date"
                                       value="{{old('departure_date')}}" id="departure_date" required/>
                            </div>
                            <div class="form-group">
                                <label for="departure_time">Departure Time</label>
                                <input type="time" class="form-control" name="departure_time"
                                       value="{{old('departure_time')}}" id="departure_time" required/>
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Create Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
