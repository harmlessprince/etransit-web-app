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
                        <li class="breadcrumb-item">Add Weight</li>
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

    <div class="container-fluid" >
        <div class="button-box" >
            <div>

            </div>
            <div>
                <button class="btn s add-terminal-button btn-sm" >Bulk Upload</button>
                <button class="btn s add-terminal-button btn-sm"  data-toggle="modal" data-target="#vehicleModal">Add Dimension</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div >
                    @if(count($weights) > 0)

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Min(kg)</th>
                                <th scope="col">Max(Kg)</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($weights as $index =>  $weight)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$weight->min_weight}}</td>
                                    <td>{{$weight->max_weight}}</td>
                                    <td>&#8358; {{number_format($weight->amount)}}</td>
                                    <td>Edit|Delete</td>
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
                    <h2 class="modal-title" id="exampleModalLabel" >Dimension Chart (Weight)</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form >
                    <div class="modal-body">
                        <br>

                        <div class="form-group">
                            <label for="min_weight">Minimum Weight (KG)</label>
                            <input type="number" class="form-control" name="min_weight" id="min_weight" />
                        </div>
                        <div class="form-group">
                            <label for="max_weight">Maximum Weight (KG) </label>
                            <input type="number" class="form-control" name="max_weight" id="max_weight" />
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount </label>
                            <input type="number" class="form-control" name="amount" id="amount" step="0.01"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close" data-dismiss="modal">Close</button>
                        <button type="button" class="send-btn  btn-submit" id="send-btn">Add Weight</button>
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
            var max     = $('#max_weight').val();
            var min     = $('#min_weight').val();
            var amount  = $('#amount').val();

            $("#send-btn").prop('disabled', true);

            $.ajax({
                type:'POST',
                url: "/admin/add/dimension/weight",
                data:{"_token": "{{ csrf_token() }}",max , min , amount},
                success:function(data){
                    if(data.success)
                    {
                        displaySuccessMessage(data.message)
                        setTimeout(function(){location.reload(true);}, 3000);

                    }else{
                        displayErrorMessage(response.message);
                        setTimeout(function(){location.reload(true);}, 3000);
                    }
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
