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
    .off_trip{
        background:green;
        color:white;
        padding:10px;
        border-radius: 4px;
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
    .action_btn{
        background:  #DC6513;
        border:1px solid  #DC6513;
        padding:4px;
        color:white;
        border-radius:4px;
    }
    .action_btn:hover{
        background:  #021037;
        border:2px solid #DC6513;
        padding:4px;
        color:white;
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
        <div class="button-box" >
            <div>
                <button class="btn s add-terminal-button btn-sm" >Currently On Trip</button>
            </div>
            <div>
                <a href="{{url('/admin/import-export-cars')}}" class="btn bulk-upload-button btn-sm"  style="margin-right:10px;">Bulk Import Cars</a>&nbsp;
                <button class="btn s add-terminal-button btn-sm"  data-toggle="modal" data-target="#vehicleModal">Add Cars</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                    <div class="otn-group col-md-4" style="display: flex;" >
                        <input type="text" name="search" placeholder="Search with Registration Number , Car Type or Model ..." id="search-box" class="form-control"/>
                        <button class="btn btn-sm btn-primary">Search</button>
                    </div>
                </div>

                <div>
                    @if(count($carsOnTripCurrently) > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Vehicle type</th>
                                    <th scope="col">Trip Status</th>
                                    <th scope="col">Pick Up Date</th>
                                    <th scope="col">PickUp Time</th>
                                    <th scope="col">Return  Date</th>
                                    <th scope="col">Return time</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carsOnTripCurrently as $car)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$car->car->car_type}}</td>
                                    <td>
                                      <span class="off_trip">
                                          {{$car->available_status}}
                                      </span>
                                    </td>
                                    <td>
                                        {{$car->date->format('Y M d')}}
                                    </td>
                                    <td>
                                        {{$car->time->format('H:i:s')}}
                                    </td>
                                    <td>
                                        {{$car->returnDate->format('Y M d')}}
                                    </td>
                                    <td>
                                        {{$car->returnTime->format('H:i:s')}}
                                    </td>
                                    <td>
                                      <a href="{{url('admin/car/details/'.$car->id)}}">
                                          <button class="action_btn">View Action</button>
                                      </a>

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

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


    <!-- modal box -->

    <div class="modal fade" id="vehicleModal" tabindex="-1" role="dialog" aria-labelledby="vehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel" >Add Car</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form >

                    <div class="modal-body">
                        <br>
                        <div class="form-group">
                            <label for="car_type">Car Type</label>
                            <input type="text" class="form-control" name="car_type" id="car_type" required/>
                        </div>

                        <div class="form-group">
                            <label for="capacity">Seat Capacity</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" required/>
                        </div>

                        <div class="form-group">
                            <label for="car_class">Car Class </label>
                            <input type="text" class="form-control" name="car_class" id="car_class" required/>
                        </div>

                        <div class="form-group">
                            <label for="daily_rentals">Daily Rentals</label>
                            <input type="text" class="form-control" name="daily_rentals" id="daily_rentals" required/>
                        </div>

                        <div class="form-group">
                            <label for="extra_hour">Extra Hour</label>
                            <input type="text" class="form-control" name="extra_hour" id="extra_hour" required/>
                        </div>

                        <div class="form-group">
                            <label for="sw_region_fare">SW Region (Fare)r</label>
                            <input type="text" class="form-control" name="sw_region_fare" id="sw_region_fare" required/>
                        </div>

                        <div class="form-group">
                            <label for="se_region_fare">SE Region (Fare)</label>
                            <input type="text" class="form-control" name="se_region_fare" id="se_region_fare" required/>
                        </div>

                        <div class="form-group">
                            <label for="ss_region_fare">SS Region (Fare)</label>
                            <input type="text" class="form-control" name="ss_region_fare" id="ss_region_fare" required/>
                        </div>

                        <div class="form-group">
                            <label for="nc_region_fare">NC Region (Fare)</label>
                            <input type="text" class="form-control" name="nc_region_fare" id="nc_region_fare" required/>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="10" cols="20" required></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close" data-dismiss="modal">Close</button>
                        <button type="button" class="send-btn  btn-submit" id="send-btn">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end modal box here -->
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e){
            e.preventDefault();

            var car_class         = $("input[name=car_class]").val();
            var car_type          = $("input[name=car_type]").val();
            var daily_rentals     = $("input[name=daily_rentals]").val();
            var capacity          = $("input[name=capacity]").val();
            var extra_hour        = $("input[name=extra_hour]").val();
            var sw_fare           = $("input[name=sw_region_fare]").val();
            var ss_fare           = $("input[name=ss_region_fare]").val();
            var se_fare           = $("input[name=se_region_fare]").val();
            var nc_fare           = $("input[name=nc_region_fare]").val();
            var description       = $("#description").val();


            $("#send-btn").prop('disabled', true);

            $.ajax({
                type:'POST',
                url: "/admin/add/cars",
                data:{"_token": "{{ csrf_token() }}",car_class, car_type,daily_rentals , extra_hour , sw_fare , ss_fare , se_fare, nc_fare , capacity ,description},
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
