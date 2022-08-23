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
                        <li class="breadcrumb-item">Ferry Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="button-box" >
            <div>
                <a href="{{url('admin/add/ferry')}}">
                <button class="btn s add-terminal-button btn-sm"  >Add Ferry</button>
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="vehicle-box">
                    @if(count($ferries) > 0)
                        @foreach($ferries as $ferry)
                            <div class="card text-white terminal-card mb-3" style="max-width: 18rem;">
                                <div class="card-body" style="display: flex;justify-content: center;">
                                    <small class="card-title"> {{strtoupper($ferry->name)}}</small>
                                </div>
                                <div class="card-footer terminal-card" style="display: flex;justify-content: center;">
                                    <a href="{{url('/admin/ferry/'.$ferry->id.'/history')}}" class="btn schedule-button">View</a>
                                    <a href="{{url('/admin/ferry/schedule-trips/'.$ferry->id)}}" class="btn schedule-button">Schedule </a>
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

    </div>

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e){
            e.preventDefault();

            var car_class         = $("#car_class").val();
            var car_type          = $("#car_type").val();
            var daily_rentals     = $("input[name=daily_rentals]").val();
            var capacity          = $("input[name=capacity]").val();
            var extra_hour        = $("input[name=extra_hour]").val();
            var sw_fare           = $("input[name=sw_region_fare]").val();
            var ss_fare           = $("input[name=ss_region_fare]").val();
            var se_fare           = $("input[name=se_region_fare]").val();
            var nc_fare           = $("input[name=nc_region_fare]").val();
            var description       = $("#description").val();
            var car_registration  = $("input[name=car_registration]").val();
            var car_brand         = $("input[name=car_brand]").val();


            $("#send-btn").prop('disabled', true);

            $.ajax({
                type:'POST',
                url: "/admin/store/car",
                data:{"_token": "{{ csrf_token() }}",car_class, car_type,daily_rentals , extra_hour ,
                    sw_fare , ss_fare , se_fare, nc_fare , capacity ,description,car_registration ,car_brand},
                success:function(data){
                    if(data.success)
                    {
                        displaySuccessMessage(data.message)
                        setTimeout(function(){
                            location.reload(true);
                        }, 2000);
                    }
                }
            });

        });

        function displaySuccessMessage(message) {
            toastr.success(message, 'Success');
        }

    </script>

@endsection
