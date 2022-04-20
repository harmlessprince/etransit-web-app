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
                        <li class="breadcrumb-item">Add City</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="button-box" >
            <div>

            </div>
            <div>
{{--                <button class="btn s add-terminal-button btn-sm" >Bulk Upload</button>--}}
                <button class="btn s add-terminal-button btn-sm"  data-toggle="modal" data-target="#vehicleModal">Add City</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div >
                    @if(count($states) > 0)

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">States</th>
                                <th scope="col">Cities</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $index =>  $city)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$city->state->name}}</td>
                                    <td>{{Ucfirst($city->name)}}</td>
                                    <td>&#8358; {{number_format($city->amount)}}</td>
                                    <td><a href="{{url('/admin/edit-city/'. $city->id. '/parcel')}}">Edit </a>|Delete</td>
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
                    <h2 class="modal-title" id="exampleModalLabel" >State</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form >
                    <div class="modal-body">
                        <br>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" name="state" id="state">
                                <option>Select State</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="city" />
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close" data-dismiss="modal">Close</button>
                        <button type="button" class="send-btn  btn-submit" id="send-btn">Add State</button>
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
            var state_id   = $('#state').val();
            var city       = $('#city').val();
            var amount       = $('#amount').val();

            $("#send-btn").prop('disabled', true);

            $.ajax({
                type:'POST',
                url: "/admin/add/city",
                data:{"_token": "{{ csrf_token() }}",state_id , city , amount},
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
