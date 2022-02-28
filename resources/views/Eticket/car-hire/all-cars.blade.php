@extends('Eticket.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }

    input:focus{
        outline:none !important;
    }
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    .add_bus_btn{
        display: flex;
        justify-content: flex-end;
    }
    .space-left{
        margin-left: 10px;
        margin-bottom:10px;
    }
    a{
        text-decoration: none !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Car Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$CountCars}}</h1>
                            <h6>Car(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('e-ticket/terminals')}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
{{--                                <h1>{{$terminalCount}}</h1>--}}
                                <h6>Terminal(s)</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('e-ticket/all-scheduled-trip')}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
{{--                                <h1>{{$schedule}}</h1>--}}
                                <h6>Total Rental</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>100</h1>
                            <h6>Transaction(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                <div class="add_bus_btn">
                    <div class="space-left">
                        <a href="{{url('e-ticket/add-car')}}" class="btn btn-success">Add Car(s)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Car Name</th>
                        <th>Car Registration</th>
                        <th>Transmission</th>
                        <th>Model</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $.noConflict();

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('e-ticket.view-all-cars') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'car_name', name: 'car_name'},
                    {data: 'car_registration', name: 'car_registration'},
                    {data: 'transmission', name: 'transmission'},
                    {data: 'model_year', name: 'model_year'},
                    {data: 'capacity', name: 'capacity'},


                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });

        });
    </script>
@endsection
