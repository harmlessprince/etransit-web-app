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
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Update Bus</li>
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
                        <form action="{{url('admin/update-bus/'.$bus->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="bus_model">Bus Model</label>
                                <input type="text" class="form-control" name="bus_model" value="{{$bus->bus_model}}"
                                       id="bus_model"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_type">Bus Type</label>
                                <input type="text" class="form-control" name="bus_type" value="{{$bus->bus_type}}"
                                       id="bus_type"/>
                            </div>
                            <div class="form-group">
                                <label for="registration">Bus Registration</label>
                                <input type="text" class="form-control" name="bus_registration"
                                       value="{{$bus->bus_registration}}" id="registration"/>
                            </div>
                            <div class="form-group">
                                <label for="wheels">Bus Wheels</label>
                                <input type="text" class="form-control" name="wheels" value="{{$bus->wheels}}"
                                       id="wheels"/>
                            </div>
                            <div class="form-group">
                                <label for="seater">Bus Seater</label>
                                <input type="text" class="form-control" name="seater" value="{{$bus->seater}}"
                                       id="seater"/>
                            </div>
                            <div class="form-group">
                                <label for="bus_model">Air Conditioning</label>
                                <input type="checkbox" name="air_conditioning"
                                       @if($bus->air_conditioning == 1) checked @endif/>
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Update Bus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
