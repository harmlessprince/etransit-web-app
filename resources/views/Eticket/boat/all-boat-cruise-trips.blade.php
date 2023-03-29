@extends('Eticket.layout.app')
<style>
    
</style>

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Scheduled Cruises</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Cruise Name</th>
                        <th>Departure Date</th>
                        <th>Departure Time</th>
                        <th>Description</th>
                        <th>Duration</th>
                        <th>Boat Name</th>
                        <th>Cruise Destination</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($boatCruises as $boatCruise)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$boatCruise->cruise_name}}</td>
                            <td>{{$boatCruise->departure_date}}</td>
                            <td>{{$boatCruise->departure_time}}</td>
                            <td>{{$boatCruise->description}}</td>
                            <td>{{$boatCruise->duration}}</td>
                            <td>{{$boatCruise->boat->name}}</td>
                            <td>{{$boatCruise->cruiselocation->destination}}</td>
                            <td>
                                <a href="{{url('e-ticket/edit-boat-trip/'.$boatCruise->id)}}"><button class="btn btn-success">Edit</button></a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" onclick="deleteItem({{$boatCruise->id}})">
                                 Delete Cruise
                                </button>
                            </td>
                        </tr>
                        @endforeach
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
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Boat Cruise?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this boat cruise?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a id="delete_url" type="button" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
    function deleteItem(id) {
        $('#edit_id').val(id)
        $('#delete_url').attr('href', "{{url('e-ticket/delete-boat-trip')}}/"+id)
        $('#deleteItemModal').modal('show')
    }
</script>

@endsection