@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Terminal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" >
       <div class="row">
           <div class="col-md-1 col-lg-1 col-sm-1 col-xl-1"></div>
          <div class="col-md-5 col-lg-5 col-xl-5 col-sm-5">
              <div class="card">
                  <div class="card-body">
                      <h5>Terminal Information</h5>
                      <hr>
                      <h6>Terminal Name : {{$terminal->terminal_name}}</h6>
                      <hr>
                      <h6>Terminal Address : {{$terminal->terminal_address}}</h6>
                      <hr>
                      <h6>City : {{$terminal->destination->location}}</h6>
                      <hr>
                  </div>
              </div>
          </div>
           <div class="col-md-5 col-lg-5 col-xl-5 col-sm-5">
               <div class="card">
                   <div class="card-body">
                       <h5>Company's Information</h5>
                       <hr>
                       <h6>Company's Name : {{$terminal->tenant->company_name}}</h6>
                       <hr>
                       <h6>Display NAme : {{$terminal->tenant->display_name}}</h6>
                       <hr>
                       <h6>Company's Address : {{$terminal->tenant->address}}</h6>
                       <hr>
                       <h6>Phone Number : {{$terminal->tenant->phone_number}}</h6>
                       <hr>
                       <h6>Image : {{$terminal->tenant->image_url ? 'Uploaded' : 'Not Uploaded'}}</h6>
                       <hr>
                   </div>
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
        $(function () {
            $.noConflict();

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.fetch-all-tenants-terminal') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'terminal_name', name: 'terminal_name'},
                    {data: 'terminal_address', name: 'terminal_address'},
                    {data: 'tenant.company_name', name: 'tenant.company_name'},
                    {data: 'destination.location', name: 'destination.location'},

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
