@extends('admin.layout.app')
<style>
    input {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;

    }

    input:focus {
        outline: none !important;
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Update Permissions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
            <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2"></div>
            <div class="col-md-7 col-lg-7 col-xl-7 col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{url('admin/update-permission/'.$permission->id)}}">
                            @csrf
                            @method('put')
                            <hr>
                            <h5>Update Permissions</h5>
                            <hr>
                            <div class="form-group">
                                <label for="permission">Permission Name</label>
                                <input type="text" name="permission" id="permission" value="{{$permission->name}}"
                                       class="form-control"/>
                            </div>
                            <button class="btn btn-success">Update Permission</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
