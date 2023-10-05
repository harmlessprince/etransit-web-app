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
                        <li class="breadcrumb-item">Manage Operator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$busesCount}}</h1>
                            <h6>Bus(es)</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
                                <h1>{{$terminalCount}}</h1>
                                <h6>Terminal(s)</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>&#x20A6; {{number_format($transactionsCount)}}</h1>
                            <h6>Transaction(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bus Model</th>
                        <th>Bus Type</th>
                        <th>Registration</th>
                        <th>Operator</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->bus_model }}</td>
                            <td>{{ $record->bus_type }}</td>
                            <td>{{ $record->bus_registration }}</td>
                            <td>{{ $record->tenant?$record->tenant->company_name:null }}</td>
                            <td>
                                <a href='/admin/manage/view-tenant-bus/{{ $record->id }}'
                                   class='edit btn btn-success btn-sm'>View</a>
                                <a href='/admin/edit-bus/{{ $record->id }}' class='btn btn-primary btn-sm'>Edit</a>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">DELETE BUS?</h5>
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
            $('#delete_url').attr('href', "{{url('admin/manage/delete-tenant-bus')}}/" + id)
            $('#deleteItemModal').modal('show')
        }
    </script>

@endsection
