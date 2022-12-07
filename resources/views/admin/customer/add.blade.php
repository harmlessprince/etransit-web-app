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
                        <li class="breadcrumb-item">Add Customer</li>
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
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('admin/store-customer/')}}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Full Name</label>
                                    <input type="text" class="form-control" required name="full_name" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Username</label>
                                    <input type="text" class="form-control" required name="username" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Email</label>
                                    <input type="email" name="email" required class="form-control" id="inputPassword4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Phone Number</label>
                                    <input type="tel" name="phone_number" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputZip">NIN</label>
                                    <input type="number" name="nin"  class="form-control" id="inputZip">
                                </div>
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
