@extends('admin.layout.app')
<style>
    .button-box{
        display:flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    #search-box{
        border: 1px solid black;
    }
    .vehicle-box{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }
    .terminal-card{
        background: #021037 !important;
        border-radius: 20px !important;
    }
    .bulk-upload-button , .add-terminal-button{
        background: #021037 !important;
        cursor: pointer;
        opacity: 0.8 !important;
        border: 1px solid  #021037 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
    }
    .bulk-upload-button:hover , .add-terminal-button:hover{
        background: #DC6513 !important;
        opacity: 0.8 !important;
        border: 1px solid  #DC6513 !important;
        color: #fff !important;
        border-radius: 5px !important;
        width: 240px !important;
        cursor: pointer;
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

    .send-btn{
        background: #021037;
        color:white !important;
        padding:10px;
        border-radius:2px;
        border:1px solid #021037;
    }
    .send-btn:hover{
        background: #DC6513;
        color:white !important;
        padding:8px;
        border-radius:2px;
        border:1px solid #DC6513;

    }
    .btn-close{
        background:#e70c0c;
        /*#021037;*/
        color:white !important;
        padding:10px;
        border-radius:2px;
        border:1px solid #e70c0c;
    }
    .btn-close:hover{
        background:#e70c0c;
        color:white !important;
        padding:8px;
        border-radius:2px;
    }
    /*480px, 768px,*/
    @media screen and (max-width: 480px) {
        .vehicle-box{
            display: grid;
            grid-template-columns: auto auto;
        }
    }

    @media screen and (max-width: 380px) {
        .vehicle-box{
            display: grid;
            grid-template-columns: auto;
        }
    }

.no_data_img{
    display:grid;
    grid-template-columns: repeat(5,1fr);
}
.not_found{
    grid-column:1/5;
   margin-left:170%;

}
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    a{
        text-decoration: none !important;
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Car Hiring Management</li>
                    </ol>
                </div>
{{--                <div class="col-6">--}}
{{--                    <!-- Bookmark Start-->--}}
{{--                    <div class="bookmark pull-right">--}}
{{--                        <ul>--}}
{{--                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>--}}
{{--                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>--}}
{{--                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>--}}
{{--                            <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>--}}
{{--                                <form class="form-inline search-form" action="#" method="get">--}}
{{--                                    <div class="form-group form-control-search">--}}
{{--                                        <div class="Typeahead Typeahead--twitterUsers">--}}
{{--                                            <div class="u-posRelative">--}}
{{--                                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search.." name="q" title="" autofocus>--}}
{{--                                                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="Typeahead-menu"></div>--}}
{{--                                            <script id="result-template" type="text/x-handlebars-template">--}}
{{--                                                <div class="ProfileCard u-cf">--}}
{{--                                                    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>--}}
{{--                                                    <div class="ProfileCard-details">--}}
{{--                                                        <div class="ProfileCard-realName">some name</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </script>--}}
{{--                                            <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <!-- Bookmark Ends-->--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="container-fluid" >
{{--        <div class="button-box" >--}}
{{--            <div>--}}
{{--                <a href="{{url('admin/cars/on-trip')}}">--}}
{{--                    <button class="btn s add-terminal-button btn-sm" >Currently On Trip</button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <a href="{{url('/admin/import-export-cars')}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">Bulk Import Cars</a>&nbsp;--}}

{{--                <a href="{{url('admin/add/car-hire')}}">--}}
{{--                    <button class="btn s add-terminal-button btn-sm"  >Add Cars</button>--}}
{{--                </a>--}}

{{--                data-toggle="modal" data-target="#vehicleModal"--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('admin/off-trips-car')}}">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$offTripCount}}</h1>
                            <h6>Off Trip</h6>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <a href="{{url('admin/on-trips-car')}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-text">
                                <h1>{{$onTripCount}}</h1>
                                <h6>On Trip</h6>
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
                            <h1>&#x20A6; {{number_format($transactions)}}</h1>
                            <h6>Transactions</h6>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered yajra-datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Car Name</th>
                        <th>Car Registration</th>
                        <th>Transmission</th>
                        <th>Model</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


{{--    <script>--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $(".btn-submit").click(function(e){--}}
{{--            e.preventDefault();--}}

{{--            var car_class         = $("#car_class").val();--}}
{{--            var car_type          = $("#car_type").val();--}}
{{--            var daily_rentals     = $("input[name=daily_rentals]").val();--}}
{{--            var capacity          = $("input[name=capacity]").val();--}}
{{--            var extra_hour        = $("input[name=extra_hour]").val();--}}
{{--            var sw_fare           = $("input[name=sw_region_fare]").val();--}}
{{--            var ss_fare           = $("input[name=ss_region_fare]").val();--}}
{{--            var se_fare           = $("input[name=se_region_fare]").val();--}}
{{--            var nc_fare           = $("input[name=nc_region_fare]").val();--}}
{{--            var description       = $("#description").val();--}}
{{--            var car_registration  = $("input[name=car_registration]").val();--}}
{{--            var car_brand         = $("input[name=car_brand]").val();--}}


{{--            $("#send-btn").prop('disabled', true);--}}

{{--            $.ajax({--}}
{{--                type:'POST',--}}
{{--                url: "/admin/store/car",--}}
{{--                data:{"_token": "{{ csrf_token() }}",car_class, car_type,daily_rentals , extra_hour ,--}}
{{--                    sw_fare , ss_fare , se_fare, nc_fare , capacity ,description,car_registration ,car_brand},--}}
{{--                success:function(data){--}}
{{--                    if(data.success)--}}
{{--                    {--}}
{{--                        displaySuccessMessage(data.message)--}}
{{--                        setTimeout(function(){--}}
{{--                            location.reload(true);--}}
{{--                        }, 2000);--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}

{{--        function displaySuccessMessage(message) {--}}
{{--            toastr.success(message, 'Success');--}}
{{--        }--}}

{{--    </script>--}}

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
                ajax: "{{ route('admin.fetch-all-cars') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'car_name', name: 'car_name'},
                    {data: 'car_registration', name: 'car_registration'},
                    {data: 'transmission', name: 'transmission'},
                    {data: 'model_year', name: 'model_year'},
                    {data: 'capacity', name: 'capacity'},


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
