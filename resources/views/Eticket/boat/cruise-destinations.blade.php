@extends('Eticket.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Cruise Destinations</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
               <div class="add_bus_btn">
                   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                        Add New Location
                   </button>
               </div>
            </div>
        </div>
    </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Destination</th>
                        <th>Destination ID</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($destinations as $destination)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$destination->destination}}</td>
                            <td>{{$destination->id}}</td>
                            <td>
                                <a href='#' class='btn btn-primary btn-sm' onclick='editItem({{$destination->id}})'>Edit</a>
                                <a href='#' class='delete btn btn-danger btn-sm' onclick='deleteItem({{$destination->id}})'>Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal for Adding Location -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
       <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
       </div>
       <div class="modal-body">
            <form action="{{url('e-ticket/boats/cruise-destinations/save')}}" method="post" id="addDestinationForm">
            @csrf
                <div class="form-group">
                    <label for="destination">Destination Name</label>
                    <input type="text" class="form-control" name="destination" value="" id="destination"/>
                </div>

            </form>
       </div>
       <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" value="Save" class="btn btn-primary" form="addDestinationForm">
       </div>
    </div>
  </div>
</div>

<!-- Modal for Editing Location-->
<div class="modal fade" id="exampleModalCenterEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form method="post" id="addDestinationForm2">
            @csrf
                <div class="form-group">
                    <label for="destination">Destination Name</label>
                    <input type="text" class="form-control destination-input" name="destination" id="destination"/>
                </div>

            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="addDestinationForm2">Save changes</button>
      </div>
    </div>
  </div>
</div>

 <!-- Modal for Deleting Location -->
<div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this location?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a id="delete_url"><button type="button" class="btn btn-danger">Delete</button></a>
      </div>
    </div>
  </div>
</div>


<script>
    function deleteItem(id){
        $('#edit_id').val(id)
        $('#delete_url').attr('href', "{{url('e-ticket/boats/cruise-destination/delete')}}/"+id)
        $('#exampleModalCenterDelete').modal('show')
    }

    function editItem(id){
        $('#edit_id').val(id)
        $('#addDestinationForm2').attr('action', "{{'cruise-destination/update'}}/"+id)
        // $('.destination-input').attr('value', "{{$destination->destination}}")
        $('#exampleModalCenterEdit').modal('show')
    }
</script>



@endsection    

