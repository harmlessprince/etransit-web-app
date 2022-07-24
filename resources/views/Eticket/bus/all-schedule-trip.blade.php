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
                        <li class="breadcrumb-item">Bus Schedules</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Bus Number Plate</th>
                        <th>Terminal Name (PickUp)</th>
                        <th>Fare (Adult)</th>
                        <th>Fare (Child)</th>
                        <th>Seats Available</th>
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
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $.noConflict();

            var table = $('.yajra-datatable').DataTable({
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.childRowImmediate,
                        type: 'none',
                        target: ''
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('e-ticket.fetch-scheduled-trip') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'pickup.location', name: 'pickup.location'},
                    {data: 'destination.location', name: 'destination.location'},
                    {data: 'bus.bus_registration', name: 'bus.bus_registration'},
                    {data: 'terminal.terminal_name', name: 'terminal.terminal_name'},
                    {data: 'fare_adult', name: 'fare_adult'},
                    {data: 'fare_children', name: 'fare_children'},
                    {data: 'seats_available', name: 'seats_available'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ],
                columnDefs: [
                    { responsivePriority: 1, targets: 1 },
                    { responsivePriority: 2, targets: 2 },
                    { responsivePriority: 3, targets: 3 },
                    { responsivePriority: 4, targets: 4 }

                ]
            });

        });
    </script>
@endsection
