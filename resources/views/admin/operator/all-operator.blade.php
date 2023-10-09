@extends('admin.layout.app')
<style>
    .push-right {
        display: flex;
        justify-content: flex-end;
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
                        <li class="breadcrumb-item">Manage Operator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="push-right">
            <div>
                <a href="{{url('admin/create-new-operator')}}" class="btn btn-success">Add Operator</a>
            </div>

            <br><br>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->company_name }}</td>
                            <td>{{ $record->address }}</td>
                            <td>{{ $record->phone_number }}</td>
                            <td>
                                <a href='/admin/view-operator/{{ $record->id }}'
                                   class='edit btn btn-success btn-sm'>View</a>
                                <a href='/admin/operator/{{ $record->id }}'
                                   class='edit btn btn-primary btn-sm'>Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $records->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@endsection
