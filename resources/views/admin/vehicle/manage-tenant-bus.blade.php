@extends('admin.layout.app')
<style>
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Manage Operator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >

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
                   <div class="card">
                       <div class="card-body">
                           <div class="align-text">
                               <h1>{{$terminalCount}}</h1>
                               <h6>Terminal(s)</h6>
                           </div>
                       </div>
                   </div>
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
                <table class="table table-bordered yajra-datatable">
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
                ajax: "{{ route('admin.manage-fetch-all-buses') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'bus_model', name: 'bus_model'},
                    {data: 'bus_type', name: 'bus_type'},
                    {data: 'bus_registration', name: 'bus_registration'},
                    {data: 'tenant.company_name', name: 'tenant.company_name'},

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
