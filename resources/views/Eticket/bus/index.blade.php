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
                            <h1>{{$busCount}}</h1>
                            <h6>Bus(es)</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('e-ticket/terminals')}}">
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
                <a href="{{url('e-ticket/all-scheduled-trip')}}">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$schedule}}</h1>
                            <h6>Total Scheduled Trips</h6>
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
                       <a href="{{url('e-ticket/import-export-schedule')}}" class="btn btn-success">Bulk Upload Schedules</a>
                   </div>
                   <div class="space-left">
                       <a href="{{url('e-ticket/add-new-tenant-bus')}}" class="btn btn-success">Add Bus(es)</a>
                   </div>
                   <div class="space-left">
                       <a href="{{url('e-ticket/all-scheduled-trip')}}" class="btn btn-success">Scheduled Trips</a>
                   </div>
               </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bus Type</th>
                        <th>Bus Model</th>
                        <th>Car Registration</th>
                        <th>Seats</th>
                        <th>Wheels</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <a id="delete_url"><button type="button" class="btn btn-danger">Delete</button></a>
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
                ajax: "{{ route('e-ticket.fetch-tenant-buses') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'bus_type', name: 'bus_type'},
                    {data: 'bus_model', name: 'bus_model'},
                    {data: 'bus_registration', name: 'bus_registration'},
                    {data: 'seater', name: 'seater'},
                    {data: 'wheels', name: 'wheels'},

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
                    { responsivePriority: 3, targets: 3 }

                ]
            });

        });


        function deleteItem(id){
            console.log('------------',id);
            $('#edit_id').val(id)
            $('#delete_url').attr('href', "{{url('e-ticket/delete-tenant-bus')}}/"+id)
            $('#deleteItemModal').modal('show')
        }
    </script>
@endsection
