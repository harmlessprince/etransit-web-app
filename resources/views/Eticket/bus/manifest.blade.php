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
                    <h3>{{\App\Models\Tenant::first()->company_name ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Bus</li>
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
                            <h1>1000</h1>
                            <h6>Actual Return</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>100</h1>
                            <h6>Expected Return</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                <div class="add_bus_btn">
                    <div class="space-left">
                        <a href="" class="btn btn-success">Download Manifest</a>
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
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Age Range</th>
                        <th>Booked By</th>
                        <th>Seat Position</th>
{{--                        <th>Booked Status</th>--}}
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
                ajax: "{{ route('e-ticket.fetch-bus-manifest', [$schedule->id]) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'passenger_age_range', name: 'passenger_age_range'},
                    {data: 'user.email', name: 'user.email'},
                    {data: 'seat_position.seat_position', name: 'seat_position.seat_position'},
                    // {data: 'seat_position.booked_status', name: 'seat_position.booked_status'},

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
