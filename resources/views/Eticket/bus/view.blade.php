@extends('Eticket.layout.app')
<style>
    .func{
        background: green;
        color:white;
        padding:4px;
        border-radius: 5px;
    }
    .not_func{
        background: red;
        color:white;
        padding:4px;
        border-radius: 5px;
    }
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    .bus_event{
        display: flex;
        justify-content: flex-end;
    }
    .schedule_trip , .schedules, .assign_drivers{
        margin-left: 10px;
    }
    .assign_driver{
        display: flex;
        justify-content: center;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{\App\Models\Tenant::first()->company_name ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/buses')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Buses</li>
                    </ol>
                </div>
                <div class="col-6">

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
                            <h1>1</h1>
                            <h6>Driver</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>100</h1>
                            <h6>Schedules</h6>
                        </div>
                    </div>
                </div>
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
            <div class="col-md-12">
                <div class="bus_event ">
                    <div class="schedule_trip">
                        <button class="btn btn-success">Schedule Trip</button>
                    </div>
                    <div class="schedules">
                        <button class="btn btn-success">Check Schedule(s)</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Bus Information</h4>
                        <br>
                        <h6>Bus Type : {{$findBus->bus_type}}</h6>
                        <hr>
                        <h6>Bus Model : {{$findBus->bus_model}}</h6>
                        <hr>
                        <h6>Bus Registration : {{$findBus->bus_registration}}</h6>
                        <hr>
                        <h6>Bus Wheels : {{$findBus->wheels}}</h6>
                        <hr>
                        <h6>Bus Passenger Seat : {{$findBus->seater}}</h6>
                        <hr>
                        <h6>Air Conditioning : @if($findBus->air_conditioning == 1 ) <span class="func"> Functional</span> @else <span class="not_func">Not Functional</span> @endif</h6>
                        <hr>
                        <h6>Bus Created date : {{$findBus->created_at->format('Y-m-d')}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4>Driver Information</h4>
                        <br>
                        @if(isset($findBus->driver))
                        <h6>Name : {{$findBus->driver->full_name}}</h6>
                        <hr>
                        <h6>Address : {{$findBus->driver->address}}</h6>
                        <hr>
                        <h6>Contact : {{$findBus->driver->phone_number}}</h6>
                        <hr>
                        <a href="{{url('e-ticket/remove-driver-from-bus/'.$findBus->driver->id .'/'. $findBus->id)}}" class="btn btn-danger">Remove Driver From Bus</a>
                        <hr>
                        @else
                            <div class="assign_driver">
                              <div>
                                  <a href="{{url('e-ticket/assign-driver/'.$findBus->id)}}" class="btn btn-danger">Assign Driver</a>
                              </div>
                            </div>
                        @endif
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
                ajax: "{{ route('e-ticket.fetch-tenant-buses') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'car_type', name: 'car_type'},
                    {data: 'car_model', name: 'car_model'},
                    {data: 'car_registration', name: 'car_registration'},
                    {data: 'seater', name: 'seater'},
                    {data: 'wheels', name: 'wheels'},

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
