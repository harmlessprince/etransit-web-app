@extends('admin.layout.app')
<style>
    .vehicle-cards{
        background: #021037 !important;
        border-radius: 20px !important;
    }
    .button-box{
        display:flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    #search-box{
        border: 1px solid black;
    }
    .vehicle-box{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
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
                        <li class="breadcrumb-item">Vehicle Management</li>
                    </ol>
                </div>
                <div class="col-6">
                    <!-- Bookmark Start-->
                    <div class="bookmark pull-right">
                        <ul>
                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                            <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                                <form class="form-inline search-form" action="#" method="get">
                                    <div class="form-group form-control-search">
                                        <div class="Typeahead Typeahead--twitterUsers">
                                            <div class="u-posRelative">
                                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search.." name="q" title="" autofocus>
                                                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                                            </div>
                                            <div class="Typeahead-menu"></div>
                                            <script id="result-template" type="text/x-handlebars-template">
                                                <div class="ProfileCard u-cf">
                                                    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                                                    <div class="ProfileCard-details">
                                                        <div class="ProfileCard-realName">some name</div>
                                                    </div>
                                                </div>
                                            </script>
                                            <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- Bookmark Ends-->
                </div>
            </div>
        </div>
        </div>
        <div class="container-fluid">
            <div class="button-box" >
                <a href="{{url('/admin/import')}}" class="btn btn-info btn-sm"  style="margin-right:10px;">Bulk Import Vehicle</a>&nbsp;
                <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#vehicleModal">Add Vehicle</button>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                        <div class="otn-group col-md-4" style="display: flex;" >
                            <input type="text" name="search" placeholder="Search with Registration Number , Car Type or Model ..." id="search-box" class="form-control"/>
                            <button class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>

                    <div class="vehicle-box">
                        @foreach($vehicles as $vehicle)
                        <div class="card text-white  mb-3 vehicle-cards"  style="max-width: 18rem;">
                            <div class="card-header vehicle-cards"><h5>{{strtoupper($vehicle->car_registration)}}</h5></div>
                            <div class="card-body">
                                <h6 class="card-title">Vehicle Type: {{Ucfirst($vehicle->car_model)}}</h6>
                                <p class="card-text">Car Model : {{Ucfirst($vehicle->car_type)}}</p>
                                <p class="card-text">Air Condition: {{$vehicle->air_conditioning == 1 ? 'True' : "False"}}</p>
                                <p class="card-text">Passenger Seats : {{$vehicle->seater}}2</p>
                                <p class="card-text">Wheels: {{$vehicle->wheels}}</p>
                                <div class="" style="display: flex;justify-content: center;">
                                    <a href="{{url('admin/event/'.$vehicle->id.'/schedule')}}" class="btn schedule-button">Schedule Event</a>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


    <!-- modal box -->


       <div class="modal fade" id="vehicleModal" tabindex="-1" role="dialog" aria-labelledby="vehicleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <form >

                       <div class="modal-body">
                           <br>
                           <div>
                               <label for="car_type">Car Type</label>
                               <input type="text" class="form-control" name="car_type" id="car_type" required/>
                           </div>
                           <br>
                           <div>
                               <label for="car_model">Car Model </label>
                               <input type="text" class="form-control" name="car_model" id="car_model" required/>
                           </div>
                           <br>
                           <div>
                               <label for="registration">Car Registration</label>
                               <input type="text" class="form-control" name="registration" id="registration" required/>
                           </div>
                           <br>
                           <div>
                               <label for="wheels">Car Wheels</label>
                               <input type="number" class="form-control" name="wheels" id="wheels" required/>
                           </div>
                           <br>
                           <div>
                               <label for="seat">Passenger Seat</label>
                               <input type="number" class="form-control" name="number_of_seats" id="seat" required/>
                           </div>
                           <br>

                           <div class="form-check form-switch">
                               <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="ac_status" checked>
                               <label class="form-check-label" for="flexSwitchCheckChecked">Air Coonditioning Status</label>
                           </div>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary btn-submit" >Save changes</button>
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

               var car_type       = $("input[name=car_type]").val();
               var car_model      = $("input[name=car_model]").val();
               var registration   = $("input[name=registration]").val();
               var wheels         = $("input[name=wheels]").val();
               var seats          = $("input[name=number_of_seats]").val();
               var ac_status      = $("input[type='checkbox']").is(":checked");

               if( ac_status)
               {
                   var status = 1
               }else{
                   var status = 0;
               }

               $.ajax({
                   type:'POST',
                   url: "/admin/add/vehicle",
                   data:{"_token": "{{ csrf_token() }}",car_type:car_type, car_model:car_model, car_registration:registration , wheels:wheels , seats:seats, Ac_status : status},
                   success:function(data){
                       if(data.success)
                       {
                           setTimeout(function(){
                               location.reload(true);
                           }, 3000);
                       }
                   }
               });

           });
       </script>
@endsection
