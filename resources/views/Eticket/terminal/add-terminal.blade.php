@extends('Eticket.layout.app')
<style>
    input {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;

    }

    select {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;
    }

    select:focus {
        outline: none !important;
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
                    <h3>{{$tenantCompanyName ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Create Terminal</li>
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
                        <form action="{{url('e-ticket/store-terminal')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="terminal_name">Terminal Name</label>
                                <input type="text" class="form-control" name="terminal_name"
                                       value="{{old('terminal_name')}}" id="terminal_name"/>
                            </div>
                            <div class="form-group">
                                <label for="terminal_address">Terminal Address</label>
                                <input type="text" class="form-control" name="terminal_address"
                                       value="{{old('terminal_address')}}" id="terminal_address"/>
                            </div>
                            <div class="form-group">
                                <label for="location">Location(s)</label>
                                <select name="location" class="form-control">
                                    <option> Please Select City / State</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->location}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Create Terminal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
