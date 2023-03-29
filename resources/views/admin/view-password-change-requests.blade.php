@extends('admin.layout.app')
<style>
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">View E-ticket Password Change Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    @toastr_css
        <div class="card">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Operator</th>
                        <th scope="col">Admin Approval</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($passwordRequests as $passwordRequest)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$passwordRequest->eticket->full_name}}</td>
                        <td>{{$passwordRequest->eticket->email}}</td>
                        <td>{{$passwordRequest->eticket->tenant->company_name}}</td>
                        <td>
                          <label class="switch">
                            <input type="checkbox" id="request" value="{{$passwordRequest->id}}" @if( $passwordRequest->admin_approval == 1 ) disabled @endif>
                            <span class="slider round"></span>     
                          </label>      
                          @if($passwordRequest->admin_approval == 1 )
                          <span style="color:#007BFF">Approved</span>
                          @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>   
            
                
            
        </div>
    </div>

   
    <script type="text/javascript">
        
        $('#request').on('click', function(){
            $("#pageloader").fadeIn();

            var ischecked= $('#request').is(':checked');

            var passwordRequestId = $(this).val();

            if(ischecked)
            {
                var checked = "checked"
            }else{
                var checked = "unchecked"
            }

            $.ajax({
                url: "{{url('admin/approve-password-change')}}",
                type: "POST",                
                data: {
                    "checked": checked,
                    "passwordRequestId": passwordRequestId,
                    "_token": $('input[name=_token]').val()
                },
            }).done(function(res) {
                    console.log(res);
                    if(res.status == 'success')
                    {
                        displaySuccessMessage(res.message)
                        $("#pageloader").hide();
                    }else{
                        displayErrorMessage(res.message);
                        $("#pageloader").hide();
                    }
            });
        });

        function displaySuccessMessage(message) {
            toastr.success(message);
        }
        function displayErrorMessage(message) {
            toastr.error(message);
        }



    </script>



@endsection