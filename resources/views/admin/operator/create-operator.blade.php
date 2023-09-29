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
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/operators')}}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Create Operator</li>
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
                        <form method="POST" action="{{url('admin/store-operator')}}" enctype="multipart/form-data">
                            @csrf
                            <hr>
                            <h5>Company's Information</h5>
                            <hr>
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" value="{{old('company_name')}}"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" name="display_name" id="display_name" value="{{old('display_name')}}"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="company_logo">Company's Logo (Optional)</label>
                                <input type="file" name="company_logo" id="company_logo" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="company_address">Company Address</label>
                                <input type="text" name="company_address" id="company_address"
                                       value="{{old('company_address')}}" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" value="{{old('phone_number')}}"
                                       class="form-control"/>
                            </div>
                            <hr>
                            <h5>Admin Details</h5>
                            <hr>
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" name="full_name" id="full_name" value="{{old('full_name')}}"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="{{old('email')}}"
                                       class="form-control"/>
                            </div>
                            <button class="btn btn-success">Create Operator</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
