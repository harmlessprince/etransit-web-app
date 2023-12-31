@extends('Eticket.layout.app')
<style>
    input {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;

    }

    input:focus {
        outline: none !important;
    }

    .align-text {
        text-align: center;
    }

    .three-row-grid {
        display: flex;
        justify-content: space-between;
    }

    .add_bus_btn {
        display: flex;
        justify-content: flex-end;
    }

    .space-left {
        margin-left: 10px;
        margin-bottom: 10px;
    }

    a {
        text-decoration: none !important;
    }

    .card-body h5 {
        color: green;
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
                        <li class="breadcrumb-item">Bus Schedules</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if($isEmptySeatAvailable)
        <div class="row three-row-grid container-fluid">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Note : {{$seatCount}} Bus Schedule(s) Seat Tracker are yet to be set due to bulk import
                            either set
                            them on each schedule or do a global settings for all schedules here
                        </h6>
                        <a href="{{url('e-ticket/global-seat-tracker-settings')}}" class="btn btn-danger btn-sm">Set
                            Empty Seat Tracker For all {{$seatCount}} Schedule(s)</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Container-fluid starts-->
    <div class="container-fluid">
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
                    @foreach($data as $dt)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$dt->pickup ? $dt->pickup->location : '--'}}</td>
                            <td>{{$dt->destination ? $dt->destination->location : '--'}}</td>
                            <td>{{$dt->bus ? $dt->bus->bus_registration : '--'}}</td>
                            <td>{{$dt->terminal ? $dt->terminal->terminal_name : '--'}}</td>
                            <td>{{$dt->fare_adult}}</td>
                            <td>{{$dt->fare_children}}</td>
                            <td>{{$dt->seats_available}}</td>
                            <td>
                                <a href='/e-ticket/view-each-schedule/{{$dt->id}}'
                                   class='delete btn btn-primary btn-sm'>View</a>
                                <a href='#' class='delete btn btn-danger btn-sm' onclick='deleteItem({{$dt->id}})'>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row" style="width: 400px">
                    <div class="col-md-12">
                        {{$data->links('vendor.pagination.default')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">DELETE SCHEDULED TRIP?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <P>Do you really want to delete this scheduled trip?</P>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <a id="delete_url">
                        <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>
        function deleteItem(id) {
            // console.log('------------',id);
            $('#edit_id').val(id)
            $('#delete_url').attr('href', "{{url('e-ticket/delete-each-schedule')}}/" + id)
            $('#deleteItemModal').modal('show')
        }
    </script>
    <!-- <script type="text/javascript">
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
    </script> -->
@endsection
