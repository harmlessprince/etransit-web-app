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
                        <li class="breadcrumb-item">Create Bus</li>
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
                        <form action="{{url('e-ticket/post-new-tenant-bus')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="bus_model">Bus Model</label>
                                <input type="text" class="form-control" name="bus_model" value="{{old('bus_model')}}"
                                       id="bus_model"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_year">Bus Year</label>
                                <input type="text" class="form-control" name="bus_year" value="{{old('bus_year')}}"
                                       id="bus_year"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_colour">Bus Colour</label>
                                <input type="text" class="form-control" name="bus_colour" value="{{old('bus_colour')}}"
                                       id="bus_colour"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_type">Bus Type</label>
                                <select id="bus_type" class="form-control" name="bus_type">
                                    @foreach($busTypes as $type)
                                        <option value="{{$type->type}}">{{$type->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="seater">Bus Seater</label>
                                <input type="text" class="form-control" name="seater" value="{{old('seater')}}"
                                       id="seater"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_available_seats">Number of available seats</label>
                                <input type="text" class="form-control" name="bus_available_seats"
                                       value="{{old('bus_available_seats')}}"
                                       id="bus_available_seats"/>
                            </div>
                            <div class="form-group">
                                <label for="registration">Bus Registration</label>
                                <input type="text" class="form-control" name="bus_registration"
                                       value="{{old('bus_registration')}}" id="registration"/>
                            </div>
                            <div class="form-group">
                                <label for="wheels">Bus Wheels</label>
                                <input type="text" class="form-control" name="wheels" value="{{old('wheels')}}"
                                       id="wheels"/>
                            </div>
                            <div class="form-group">
                                <label for="driver">Assign Driver</label><br>
                                <span
                                    class="optional_notes">Type in driver's phone number to assign them to the bus</span>
                                <input type="text" class="form-control" name="driver_phone_number"
                                       value="{{old('driver_phone_number')}}" id="driver"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_model">Air Conditioning</label>
                                <input type="checkbox" name="air_conditioning" checked value="on"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_pictures">Upload Vehicle Pictures</label>
                                <input type="file" multiple class="form-control" name="bus_pictures"
                                       id="bus_pictures" required/>
                            </div>
                            <div class="form-group">
                                <label for="bus_proof_of_ownership">Upload Proof of Ownership</label>
                                <input type="file" multiple class="form-control" name="bus_proof_of_ownership"
                                       id="bus_proof_of_ownership" required/>
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
