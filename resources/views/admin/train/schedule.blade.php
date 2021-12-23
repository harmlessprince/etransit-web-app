@extends('admin.layout.app')
<style>
    .button-box{
        display:flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .bulk-upload-button {
        background: #021037 !important;
        cursor: pointer;
        opacity: 0.8 !important;
        border: 1px solid  #021037 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
    }
    .sumbit_request{
        background: #021037 !important;
        cursor: pointer;
        border: 1px solid  #021037 !important;
        color: #fff !important;
        border-radius: 5px !important;
        padding:10px;
    }
    .sumbit_request:hover{
        background: #DC6513 !important;
        cursor: pointer;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        padding:10px;
    }
    .bulk-upload-button:hover {
        background: #DC6513 !important;
        opacity: 0.8 !important;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
        cursor: pointer;
    }

    .car-box{
        display: grid;
        grid-template-columns: repeat(1, 1fr);

    }
    .car-box input , select{
        outline:none !important;
        border:none !important;
        border-bottom: 1px solid #03174C !important;
    }
    input:focus ,select:focus{
        outline: none !important;
    }
    textarea {
        background-color: transparent !important;
        resize: none !important;
        outline: none !important;
        border: 1px solid #03174C !important;
    }

    textarea:focus {
        outline: none !important;
        border: 1px solid  #03174C  !important;
    }
    .image_file{
        outline: none !important;
        border:none !important;
    }
    .images-preview-div img
    {
        padding: 10px;
        max-width: 200px;
    }
    #buttonID{
        background:rgba(219, 226, 241, 0.54);
        color:white;
        padding:10px;
        border-radius: 50%;

    }
    .file_image_form{
        display:flex;
    }
    .add_butto{
        margin-top:90px;
    }
    .invalid-feedback{
        color:red !important;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        background: #ccc !important;
    }
    .coach-box{
        display:flex;
    }
    .coach-btn{
        margin-top:35px;
    }
    .train_header_text{
        display: flex;
        justify-content: center;
    }
    #route-list{
        height: 200px;
        overflow-x: scroll;
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Schedule Train Trip</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
        <div class="card">
            <div class="card-body train_header_text" >
               <div>
                   <h2>{{$train->name}}</h2>
               </div>
            </div>
        </div>
        <div class="card">

            <div class="card-body">
                <form method="post" action="{{url('/admin/manage/train/schedule')}}">
                    @csrf
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="boat_name">Pick Up</label>
                            <select class="form-control" name="pickup">
                                <option> Select Pick city </option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="seats">Final Destination</label>
                            <select class="form-control" name="destination">
                                <option> Select Destination City </option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 coach-box">
                        <div class="car-box col-md-4">
                            <div class="form-group">
                                <label for="coach_type">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required/>
                                <input type="hidden" name="train_id" value="{{$train->id}}" />
                            </div>
                        </div>
                        <div class=" car-box col-md-4">
                            <div class="form-group">
                                <label for="coach_seats">Time Of Departure</label>
                                <input type="time" name="time" id="time" class="form-control"  value="{{ old('time') }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="car-box col-md-12">
                        <h3> Pick Route(s) </h3>
                        <div id="route-list">
                            @foreach($trainRoutes as $route)
                                <div class="form-group" >
                                    <input type="checkbox" name="route[]" value="{{$route->id}}"/> {{$route->stop_name}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 coach-btn">
                        <button class="btn btn-success" >Schedule Trip</button>
                    </div>
                </form>
            </div>

        </div>
    </div>



@endsection
