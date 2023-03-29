
@extends('Eticket.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">View Profile</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>View My Profile</h4>
            </div>
            <div class="card-body">
                <h6>Full Name: {{$user->full_name}}</h6> <hr>
                <h6>Email: {{$user->email}}</h6><hr>
                <h6>Operator: {{$tenant->company_name}}</h6><hr>
                <h6>Operator Address: {{$tenant->address}}</h6><hr>
                <h6>Operator Contact: {{$tenant->phone_number}}</h6>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Edit My Profile Information</button>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit My Profile Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
               <form action="{{url('/e-ticket/update-user-profile/'.$user->id)}}" method="post" id="modal-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control" value="{{$user->full_name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" form="modal-form" value="Save changes">
      </div>
    </div>
  </div>
</div>


@endsection    