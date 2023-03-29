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
    .vehicle-box{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }
    .terminal-card{
        background: #021037 !important;
        border-radius: 20px !important;
    }
    .schedule-button {
        background:  #021037 !important;
        opacity: 0.8 !important;
        border: 1px solid #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
        cursor: pointer;
    }
    .schedule-button:hover {
        background: #DC6513 !important;
        cursor: pointer;
        opacity: 0.8 !important;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
    }
    .no_data_img{
        display:grid;
        grid-template-columns: repeat(5,1fr);
    }
    .not_found{
        grid-column:1/5;
        margin-left:170%;
    }
    .card_div {
        margin-right: 20px;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Boats</li>
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
                            <h1>{{$boatCount}}</h1>
                            <h6>Boat(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('e-ticket/all-scheduled-trip')}}">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$boatCruiseCount}}</h1>
                            <h6>Total Boat Cruises</h6>
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
                   <!-- <div class="space-left">
                       <a href="{{url('e-ticket/import-export-schedule')}}" class="btn btn-success">Bulk Upload Schedules</a>
                   </div> -->
                   <div class="space-left">
                       <a href="{{url('e-ticket/add-new-boat')}}" class="btn btn-success">Add Boat(s)</a>
                   </div>
                   <div class="space-left">
                       <a href="{{url('e-ticket/all-boat-trips')}}" class="btn btn-success">Boat Cruises</a>
                   </div>
               </div>
            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <div class="vehicle-box">
                    @if(count($boats) > 0)
                        @foreach($boats as $boat)
                            <div class="card terminal-card mb-3 card_div" style="max-width: 18rem;">
                                <div class="card-body" style="display: flex;justify-content: center;">
                                    <h4 class="card-title" style="color:white;"> {{strtoupper($boat->name)}}</h4>
                                </div>
                                <div class="card-footer terminal-card" style="display: flex;justify-content: center;">

                                    <a href="{{url('/e-ticket/view-boat/'.$boat->id)}}" class="btn schedule-button">View</a>
{{--                                    <a href="{{url('/admin/edit/'.$boat->id . '/boat')}}" class="btn schedule-button">Update</a>--}}
                                    <a href="{{url('/e-ticket/schedule-boat-trip/'.$boat->id)}}" class="btn schedule-button">Schedule</a>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="no_data_img">
                            <div class="not_found">
                                <div>
                                    <img src="{{asset('images/illustrations/empty_data.png')}}" width="400" height="300" alt="bus-image"/>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>






        <!-- <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Paths</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($boats as $boat)
                        <tr>
                            <th>{{$loop->index+1}}</th>
                            <th>{{$boat->name}}</th>
                            <th>{{$boat->location}}</th>
                            <th>{{$boat->description}}</th>
                            <th>{{$boat->paths}}</th>
                            <th></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
    <!-- Modal -->
<!-- <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
</div> -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>


@endsection    