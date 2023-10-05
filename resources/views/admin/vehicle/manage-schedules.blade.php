@extends('admin.layout.app')
<style>
    .align-text {
        text-align: center;
    }

    .three-row-grid {
        display: flex;
        justify-content: space-between;
    }

    a {
        text-decoration: none !important;
    }

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
</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Manage Schedule</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                <div class="add_bus_btn">
                    <div class="space-left">
                        <a href="{{url('admin/add-schedule')}}" class="btn btn-success">Add Schedule</a>
                    </div>
                    <div class="space-left">
                        <a href="{{url('admin/import-export-schedule')}}" class="btn btn-success">Bulk Upload
                            Schedules</a>
                    </div>
                    <div class="space-left">
                        <a href="{{url('admin/add-new-tenant-bus')}}" class="btn btn-success">Add Bus(es)</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Terminal</th>
                        <th>Operator</th>
                        <th>Service</th>
                        <th>Bus Registration</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Adult Fare</th>
                        <th>Children Fare</th>
                        <th>Departure Date</th>
                        <th>Return Date</th>
                        <th>Seats Available</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->terminal->terminal_name }}</td>
                            <td>{{ $record->tenant->company_name }}</td>
                            <td>{{ $record->service->name }}</td>
                            <td>{{ $record->bus->bus_registration }}</td>
                            <td>{{ $record->pickup->location }}</td>
                            <td>{{ $record->destination->location }}</td>
                            <td>{{ $record->fare_adult }}</td>
                            <td>{{ $record->fare_children }}</td>
                            <td>{{ $record->departure_date." ".$record->departure_time }}</td>
                            <td>{{ $record->return_date." ".$record->return_time }}</td>
                            <td>{{ $record->seats_available }}</td>
                            <td>
                                <a href='/admin/manage/view-schedule/{{ $record->id }}'
                                   class='edit btn btn-success btn-sm'>View</a>
                                <a href='/admin/edit-schedule/{{ $record->id }}' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='#' onclick='deleteItem({{ $record->id }})'
                                   class='edit btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{--                    {{ {{$records->links('vendor.pagination.default')}} }}--}}
                    {{$records->links('vendor.pagination.default')}}
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
                    <h5 class="modal-title" id="exampleModalLongTitle">DELETE SCHEDULE?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <P>Do you really want to delete this bus?</P>

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

    <script type="text/javascript">

        function deleteItem(id) {
            $('#edit_id').val(id)
            $('#delete_url').attr('href', "{{url('admin/manage/delete-schedule')}}/" + id)
            $('#deleteItemModal').modal('show')
        }
    </script>

@endsection
