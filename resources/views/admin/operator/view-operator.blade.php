@extends('admin.layout.app')
<style>
    input {
        border: 0 !important;
        border-bottom: 1px solid rgb(128, 128, 128) ! important;

    }

    a {
        text-decoration: none !important;
    }

    input:focus {
        outline: none !important;
    }

    .align-text {
        text-align: center;
    }

    .three-row-grid {
        display: flex;
        justify-content: space-between;
    }

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

    .service_name {
        font-size: 25px;

    }

    .switch_box {
        display: flex;
    }

    .pad-card {
        padding: 20px
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/operators')}}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Create Operator</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
                                <h1>{{$busCount}}</h1>
                                <h6>Bus(es)</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
                                <h1>{{$terminalCount}}</h1>
                                <h6>Terminal(s)</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1> &#x20A6; {{number_format($transactionSum)}}</h1>
                            <h6>Transaction(s)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Company's Information</h4>
                        <hr>
                        <h6>Company Name : {{$tenant->company_name}}</h6>
                        <hr>
                        <h6>Display Name : {{$tenant->display_name}}</h6>
                        <hr>
                        <h6>Address : {{$tenant->address}}</h6>
                        <hr>
                        <h6>Phone Number : {{$tenant->phone_number}}</h6>
                        <hr>
                        <h6>Logo Status: {{isset($tenant->image_url) ? 'Available' : 'Not Available'}} </h6>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                <div class="card pad-card">
                    <h4>Company's Services</h4>
                    <hr>
                    <div class="form-group">
                        @foreach($tenantServiceObject as $index => $service)
                            <div class="switch_box">
                                <div>
                                    <label class="switch">
                                        <input type="checkbox" class="services" value="{{$service['id']}}"
                                               @if( $service['status'] == 'yes' ) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div>
                                    &nbsp; &nbsp; <span class="service_name"> {{$service['service']}} </span>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".services").change(function (e) {
            e.preventDefault();

            var ischecked = $(this).is(':checked');

            var service_id = $(this).val();
            var tenant_id = {{$tenant->id}}
            console.log(tenant_id)
            console.log(service_id)

            if (ischecked) {
                var checked = "checked"
            } else {
                var checked = "unchecked"
            }

            $.ajax({
                type: 'POST',
                url: "/admin/add-service-to-tenant",
                data: {"_token": "{{ csrf_token() }}", service_id, checked, tenant_id},
                success: function (data) {

                    if (data.success) {
                        displaySuccessMessage(data.message)
                    } else {
                        displayErrorMessage(data.message);
                    }
                    setTimeout(function () {
                        location.reload(true);
                    }, 3000);
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

    <script type="text/javascript">
        $(function () {
            $.noConflict();

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/get-operator-users/'.$tenant->id)  }}",
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            console.log(data)
        });
    </script>

@endsection
