@extends('admin.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }
a{
    text-decoration: none !important;
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
</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/operators')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Create Operator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$busCount}}</h1>
                            <h6>Bus(es)</h6>
                        </div>
                    </div>
                </div>
                </a>
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
                            <h1>100</h1>
                            <h6>Transaction(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div class="card">
                    <hr>

                    <div class="card-body">
                        <hr>
                        <h6>Company Name : {{$tenant->company_name}}</h6>
                        <hr>
                        <h6>Display Name : {{$tenant->display_name}}</h6>
                        <hr>
                        <h6>Address : {{$tenant->address}}</h6>
                        <hr>
                        <h6>Phone Number : {{$tenant->phone_number}}</h6>
                        <hr>
                        <h6>Logo Status:  {{isset($tenant->image_url) ? 'Available' : 'Not Available'}} </h6>
                        <hr>
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
                        <th>email</th>
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
                ajax: "{{ url('admin/get-operator-users/'.$tenant->id)  }}",
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            console.log(data)
        });
    </script>

@endsection
