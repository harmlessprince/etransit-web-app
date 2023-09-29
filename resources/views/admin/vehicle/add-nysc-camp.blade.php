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

    .add_camp_btn {
        display: flex;
        justify-content: flex-end;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">NYSC Camps</li>
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
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                <div class="add_camp_btn">
                    <div class="space-left">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addcampmodal">Add Camp
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h2>NYSC Camps</h2>
            <div class="card-body">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Camp</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $camps as $camp )
                        <tr>
                            <td>{{$camp->id}}</td>
                            <td>{{$camp->location->location}}</td>
                            <td><a href="{{url("/admin/update/bus-location/$camp->location_id")}}"
                                   class="btn btn-success">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addcampmodal" tabindex="-1" role="dialog" aria-labelledby="addCampLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add NYSC Camp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{url('admin/nysc/store-camp/')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="location">Camp Name</label>
                                    <input type="text" class="form-control" name="name" id="location"
                                           placeholder="NYSC Camp(state)"/>
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

