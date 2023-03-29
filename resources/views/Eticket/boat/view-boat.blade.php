@extends('Eticket.layout.app')
<style>
  .add_bus_btn{
        display: flex;
        justify-content: flex-end;
    }
    .space-left{
        margin-left: 10px;
        margin-bottom:10px;
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
                        <li class="breadcrumb-item">{{strtoupper($boat->name)}}</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
               <div class="add_bus_btn">
                   <div class="space-left">
                       <a href="{{url('e-ticket/edit-boat/'.$boat->id)}}" class="btn btn-success">Edit Boat</a>
                   </div>
                   <div class="space-left">
                       <a href="{{url('e-ticket/schedule-boat-trip/'.$boat->id)}}" class="btn btn-success">Schedule Boat Cruise</a>
                   </div>
                   <div class="space-left">
                       <a href='#' class='delete btn btn-danger btn-sm' onclick='deleteItem({{$boat->id}})'>Delete Boat</a>
                   </div>
               </div>
            </div>
        </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Boat Information</h4>
                        <br>
                <h6>Boat Name : {{$boat->name? $boat->name:''}}</h6>
                        <hr>
                <h6>Location : {{$boat->location? $boat->location:''}}</h6>
                        <hr>
                <h6>Description : {{$boat->description? $boat->description:''}}</h6>
                        <hr>
                <!-- <h6>paths : {{$boat->paths? $boat->paths:''}}</h6>
                        <hr> -->
                <h6>Boat Created date : {{$boat->created_at? $boat->created_at->format('Y-m-d'): ''}}</h6>
                        <hr>
                <h6>Last Updated date : {{$boat->updated_at? $boat->updated_at->format('Y-m-d'):''}}</h6>
            </div>
        </div>
        @if($boat_images)
          @foreach($boat_images as $image)
            <div class="card">
                <img src="{{$image->path}}" alt="Boat Image" class="card-img-top">
                <div class="card-body">
                    <h6>{{$boat->name? $boat->name:''}}</h6>
                </div>

            </div>
          @endforeach
        @endif
    </div>
    <!-- Modal for Deleting Location -->
<div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Boat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this boat?
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
        $('#delete_url').attr('href', "{{url('e-ticket/delete-boat')}}/"+id)
        $('#exampleModalCenterDelete').modal('show')
    }

</script>    


@endsection    