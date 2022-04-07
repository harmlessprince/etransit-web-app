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
                        <li class="breadcrumb-item">Add State / Stops / Terminal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="button-box" >
            <div>
                {{--                <a href="{{url('/admin/import-export-cars')}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">Bulk Import Boats</a>&nbsp;--}}
            </div>
        </div>
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

    <div class="container-fluid" >

        <div class="card">

            <div class="card-body">
                <form method="post" action="{{url('/admin/store/train/routes-fare')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                            <div class="form-group">
                                <label for="train_class">Location (City)</label>
                                <select class="form-control" name="state" required>
                                    <option value=""> Select City</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                            <div class="form-group">
                                <label for="class_id">Train Route (Terminal) </label>
                                <select class="form-control @error('route_id')is-invalid @enderror" id="pickup" name="route_id">
                                </select>
                            </div>
                            @if($errors->has('route_id'))
                                <span class="invalid-feedback">
                                <strong >{{ $errors->first('route_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                   <div class="row">
                       <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                           <div class="form-group">
                               <label for="train_class">Destination (City)</label>
                               <select class="form-control" name="dest_state" required>
                                   <option value=""> Select City</option>
                                   @foreach($locations as $location)
                                       <option value="{{$location->id}}">{{$location->locations_state}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="col-md-6 col-lg-6 col-sm-6 col-xl-6">
                           <div class="form-group">
                               <label for="dest_terminal">Train Route (Destination Terminal) </label>
                               <select class="form-control @error('dest_route_id')is-invalid @enderror" id="dest_terminal" name="dest_route_id">
                               </select>
                           </div>
                           @if($errors->has('route_id'))
                               <span class="invalid-feedback">
                                <strong >{{ $errors->first('dest_route_id') }}</strong>
                            </span>
                           @endif
                       </div>
                   </div>
                    <div class="row">
                        <div class="car-box col-md-6 col-lg-6 col-sm-6 col-xl-6">
                            <div class="form-group">
                                <label for="amount_adult">Amount (Adult)</label>
                                <input type="text" name="amount_adult" id="amount_adult" class="form-control" value="{{ old('amount_adult') }}" required />
                            </div>
                        </div>
                        <div class="car-box col-md-6 col-lg-6 col-sm-6 col-xl-6">
                            <div class="form-group">
                                <label for="train_class">Amount (Child)</label>
                                <input type="text" name="amount_child" id="amount_child" class="form-control" value="{{ old('amount_child') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xl-12">
                        <div class="form-group">
                            <label for="class_id">Class </label>
                            <select class="form-control" name="class_id" required>
                                <option value=""> Select Class</option>
                                @foreach($trainClass as $class)
                                    <option value="{{$class->id}}">{{$class->class}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-success" id="coach">Add Farep</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="card">

            <div class="card-body">

                <div class="car-box col-md-12">
                    <div>
                        <h3>Routes Fare (Each Stop / Terminal) </h3>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">State</th>
                        <th scope="col">Stop</th>
                        <th scope="col">State (destination)</th>
                        <th scope="col">Stop (destination)</th>
                        <th scope="col">Class</th>
                        <th scope="col">Amount (Adult)</th>
                        <th scope="col">Amount (Child)</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    @foreach($routes as $index => $stop)
                        <tbody>
                        <tr>
                            <th scope="row">{{$index + 1}}</th>
                            <td>{{Ucfirst($stop->city->locations_state)}}</td>
                            <td>{{Ucfirst($stop->terminal->stop_name)}}</td>
                            <td>{{Ucfirst($stop->destination->locations_state)}}</td>
                            <td>{{Ucfirst($stop->destination_terminal->stop_name)}}</td>
                            <td>{{Ucfirst($stop->seatClass->class)}}</td>
                            <td>&#8358; {{number_format($stop->amount_adult)}}</td>
                            <td>&#8358; {{number_format($stop->amount_child)}}</td>
                            <td>Edit|Delete</td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
    </div>
<script>

    $(document).ready(function() {
        $('select[name="state"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/admin/pick-up-route/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="route_id"]').empty();
                        $.each(data, function(key, value) {
                            console.log(value)
                            $('select[name="route_id"]').append('<option value="'+ value.id +'">'+ value.stop_name +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="route_id"]').empty();
            }
        });
    });


    $(document).ready(function() {
        $('select[name="dest_state"]').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/admin/pick-up-route/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="dest_route_id"]').empty();
                        $.each(data, function(key, value) {
                            console.log(value)
                            $('select[name="dest_route_id"]').append('<option value="'+ value.id +'">'+ value.stop_name +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="dest_route_id"]').empty();
            }
        });
    });

</script>
@endsection
