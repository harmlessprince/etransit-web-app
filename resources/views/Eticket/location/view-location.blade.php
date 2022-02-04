@extends('Eticket.layout.app')
<style>
  .location_header{
      display: flex;
      justify-content: center;
  }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/locations')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Locations (City)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
                <div class="location_header">
                    <div><h4>{{$location->location}} </h4></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
                <h5>( {{count($location->terminals)}} ) Associated Terminal(s)</h5>
                <div class="location_header">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Terminal Name</th>
                            <th scope="col">Terminal Address</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($location->terminals as $index => $terminal)
                        <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$terminal->terminal_name}}</td>
                            <td>{{$terminal->terminal_address}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                ajax: "{{ route('e-ticket.fetch-tenant-locations') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'location', name: 'location'},
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
