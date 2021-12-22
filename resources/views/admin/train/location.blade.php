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
        <div class="card">

            <div class="card-body">
                <form method="post" action="{{url('/admin/store/train-state')}}">
                    @csrf
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="train_class">State</label>
                            <input type="text" name="train_state" id="train_state" class="form-control" value="{{ old('train_state') }}" placeholder="e.g Lagos or Kaduna" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success" id="coach">Add State</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="card">

            <div class="card-body">

                <div class="car-box col-md-12">
                    <div>
                        <h3>Locations (states)</h3>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    @foreach($locations as $index => $location)
                        <tbody>
                        <tr>
                            <th scope="row">{{$index + 1}}</th>
                            <td>{{$location->locations_state}}</td>
                            <td>Edit|Delete</td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
    <div class="container-fluid" >

        <div class="card">

            <div class="card-body">
                <form method="post" action="{{url('/admin/store/train-stops')}}">
                    @csrf
                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="train_class">Location (State)</label>
                           <select class="form-control" name="state" required>
                               <option value=""> Select State</option>
                               @foreach($locations as $location)
                                   <option value="{{$location->id}}">{{$location->locations_state}}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>

                    <div class="car-box col-md-12">
                        <div class="form-group">
                            <label for="train_class">Location (Each Stop)</label>
                            <input type="text" name="train_stop" id="train_stop" class="form-control" value="{{ old('train_stop') }}" placeholder="e.g Agege or Ibadan" required />
                        </div>
                    </div>
{{--                    <div class="car-box col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="amount_adult">Amount (Adult)</label>--}}
{{--                            <input type="text" name="amount_adult" id="amount_adult" class="form-control" value="{{ old('amount_adult') }}" required />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="car-box col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="train_class">Amount (Child)</label>--}}
{{--                            <input type="text" name="amount_child" id="amount_child" class="form-control" value="{{ old('amount_child') }}" required />--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-md-4">
                        <button class="btn btn-success" id="coach">Add Each Stop</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="card">

            <div class="card-body">

                <div class="car-box col-md-12">
                    <div>
                        <h3>Location (Each Stop / Terminal) </h3>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">State</th>
                        <th scope="col">Stop</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                        @foreach($eachstop as $index => $stop)
                            <tbody>
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{Ucfirst($stop->state->locations_state)}}</td>
                                <td>{{Ucfirst($stop->stop_name)}}</td>
                                <td>Edit|Delete</td>
                            </tr>
                            </tbody>
                        @endforeach
                </table>
            </div>

        </div>
    </div>


@endsection
