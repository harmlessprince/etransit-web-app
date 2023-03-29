@extends('Eticket.layout.app')

<style>
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
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
                        <li class="breadcrumb-item">Change Password</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
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
        <div class="card">
            <div class="card-header"><h4>Change Password</h4></div>
            <div class="card_body px-5 pb-5">
                <form action="{{url('/e-ticket/change-password/'.$user->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div>
                           <input type="password" id="current_password" name="current_password" class="form-control" required>
                           <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>                    
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div>
                           <input type="password" id="new_password" name="new_password" class="form-control" required>
                           <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password-new"></span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="reenter_password">Re-enter New Password</label>
                        <div>
                            <input type="password" id="reenter_password" name="reenter_password" class="form-control" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password-reenter"></span>
                        </div>
                       
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
       $(".toggle-password").click(function() {
       $(this).toggleClass("fa-eye fa-eye-slash");
       var x = document.getElementById("current_password");
       if (x.type === "password") {
         x.type = "text";
        } else {
        x.type = "password";
        }
       });


       $(".toggle-password-new").click(function() {
       $(this).toggleClass("fa-eye fa-eye-slash");
       var x = document.getElementById("new_password");
       if (x.type === "password") {
         x.type = "text";
        } else {
        x.type = "password";
        }
       });

       $(".toggle-password-reenter").click(function() {
       $(this).toggleClass("fa-eye fa-eye-slash");
       var x = document.getElementById("reenter_password");
       if (x.type === "password") {
         x.type = "text";
        } else {
        x.type = "password";
        }
       });




    </script>

@endsection    