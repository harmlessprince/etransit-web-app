@extends('admin.layout.app')
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
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a>
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
                        <form action="{{url('admin/add-schedule')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="tenant_id">Operator </label>
                                <select class="form-control" name="tenant_id" id="tenant_id" required>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bus_id">Bus </label>
                                <select class="form-control" name="bus_id" id="bus_id" required>
                                    @foreach($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->bus_registration }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="number_of_seats">Number of Seats Available</label>
                                <input type="text" class="form-control" name="number_of_seats"
                                       value="{{old('number_of_seats')}}"
                                       id="number_of_seats" required/>
                            </div>
                            <div class="form-group">
                                <label for="terminal_id">Terminal </label>
                                <select class="form-control" name="terminal_id" id="terminal_id" required>
                                    @foreach($terminals as $terminal)
                                        <option value="{{ $terminal->id }}">{{ $terminal->terminal_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_id">Service </label>
                                <select class="form-control" name="service_id" id="service_id" required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                <label for="adult_tfare">Adult Tfare</label>
                                <input type="text" class="form-control" name="adult_tfare"
                                       value="{{old('adult_tfare')}}"
                                       id="adult_tfare" required/>
                            </div>
                            <div class="form-group">
                                <label for="child_tfare">Child Tfare</label>
                                <input type="text" class="form-control" name="child_tfare"
                                       value="{{old('child_tfare')}}"
                                       id="child_tfare" required/>
                            </div>
                            <div class="form-group">
                                <label for="bus_available_seats">Number of available seats</label>
                                <input type="text" class="form-control" name="bus_available_seats"
                                       value="{{old('bus_available_seats')}}"
                                       id="bus_available_seats" required/>
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
                                <button class="btn btn-success">Create Bus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
