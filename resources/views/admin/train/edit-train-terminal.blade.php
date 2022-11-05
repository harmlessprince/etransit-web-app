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
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Update Train Terminal</li>
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
                        <form action="{{url('admin/update-train-terminal/'.$trainStop->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" class="form-control" name="state">
                                    <option value="{{$trainStop->state->id}}">{{$trainStop->state->locations_state}}</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="terminal">Location</label>
                                <input type="text" class="form-control" name="terminal" value="{{$trainStop->stop_name}}"  id="terminal"/>
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection