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
                        <form action="{{url('e-ticket/new-driver/')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}"
                                       id="full_name"/>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number"
                                       value="{{old('phone_number')}}" id="phone_number"/>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" value="{{old('address')}}"
                                       id="address"/>
                            </div>
                            <div class="form-group">
                                <label for="nin">NIN</label>
                                <input type="text" class="form-control" name="nin" value="{{old('nin')}}"
                                       id="nin"/>
                            </div>
                            <div class="form-group">
                                <label for="guarantor_name">Guarantor Name</label>
                                <input type="text" class="form-control" name="guarantor_name" value="{{old('guarantor_name')}}"
                                       id="guarantor_name"/>
                            </div>
                            <div class="form-group">
                                <label for="guarantor_phone_number">Guarantor Phone Number</label>
                                <input type="text" class="form-control" name="guarantor_phone_number" value="{{old('guarantor_phone_number')}}"
                                       id="guarantor_phone_number"/>
                            </div>
                            <div class="form-group">
                                <label for="guarantor_picture">Upload Guarantor's Picture</label>
                                <input type="file" class="form-control" name="guarantor_picture"
                                       value="{{old('guarantor_picture')}}" id="guarantor_picture" required/>
                            </div>
                            <div class="form-group">
                                <label for="license">Upload driver's license</label>
                                <input type="file" class="form-control" name="license"
                                       value="{{old('license')}}" id="license" required/>
                            </div>
                            <div class="form-group">
                                <label for="picture">Upload driver's Picture</label>
                                <input type="file" class="form-control" name="picture"
                                       value="{{old('picture')}}" id="picture" required/>
                            </div>
                            <div class="submit_button">
                                <button class="btn btn-success">Create Driver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
