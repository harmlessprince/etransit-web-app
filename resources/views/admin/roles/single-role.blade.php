@extends('admin.layout.app')
<style>


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
    .service_name{
        font-size: 25px;

    }
    .switch_box{
        display: flex;
    }
    .service_header{
        text-align: center;
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Create Permissions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
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
        <div class="row">
            <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2"></div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <h6>Role</h6>
                        <hr>
                      <h6>{{$role->name}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <h6>Permissions</h6>
                        <hr>
                        <div class="form-group">
                            @foreach($permissionObject as $index => $permission)
                                <hr>
                                <div class="switch_box">
                                    <div>
                                        <label class="switch">
                                            <input type="checkbox" class="permissions" value="{{$permission['id']}}"  @if( $permission['status'] == 'active' ) checked  @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div>
                                    &nbsp; &nbsp;  <span class="service_name"> {{$permission['permission']}} </span>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".permissions").change(function(e){
            e.preventDefault();

            var ischecked= $(this).is(':checked');

            var PermissionId = $(this).val();
            var role_id = {{$role->id}}

            if(ischecked)
            {
                var checked = "checked"
            }else{
                var checked = "unchecked"
            }

            $.ajax({
                type:'POST',
                url: "/admin/add-permissions-to-role",
                data:{"_token": "{{ csrf_token() }}",PermissionId , checked , role_id},
                success:function(data){
                    if(data.success)
                    {
                        displaySuccessMessage(data.message)
                    }else{
                        displayErrorMessage(response.message);
                    }
                    setTimeout(function(){location.reload(true);}, 3000);
                }
            });

        });

        function displaySuccessMessage(message) {
            toastr.success(message, 'Success');
        }
        function displayErrorMessage(message) {
            toastr.error(message, 'Error');
        }


    </script>

@endsection

