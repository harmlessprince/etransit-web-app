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
    .user-info{

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
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Customer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body user-info ">
                        <h5>Total Transactions</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body user-info ">
                        <div>
                       <h3> &#8358;  {{number_format($totalTransactions)}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body user-info ">
                           <div>
                               <img src="{{asset('images/user/user.png')}}" alt="user-img"/>
                               <hr>
                               <h6> {{$user->full_name}}</h6>
                               <hr>
                               <h6> {{$user->email}}</h6>
                               <hr>
                               <h6> {{$user->phone_number}}</h6>
                               <hr>
                               @if($user->banned_status  == 0 )
                               <a href="{{url('admin/suspend-user/'.$user->id)}}">
                                   <button class="btn btn-danger">Suspend user</button>
                               </a>
                               @else
                                   <a href="{{url('admin/activate-user/'.$user->id)}}">
                                       <button class="btn btn-success">Activate user</button>
                                   </a>
                               @endif

                           </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body user-info ">
                        <div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reference</th>
{{--                                    <th scope="col">Flutterwave Reference</th>--}}
                                    <th scope="col">Transaction Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">isConfirmed</th>
                                    <th scope="col">Service Type</th>
                                    <th scope="col">Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->transactions as $index => $tranx)
                                <tr>
                                    <th scope="row">{{$index + 1}}</th>
                                    <td>{{$tranx->reference}}</td>
{{--                                    <td>{{$tranx->trx_ref == null ? 'Nill' : $tranx->trx_ref}}</td>--}}
                                    <td>{{$tranx->transaction_type}}</td>
                                    <td>{{$tranx->status}}</td>
                                    <td>{{$tranx->isConfirmed}}</td>
                                    <td>{{$tranx->service->name}}</td>
                                    <td>{{$tranx->created_at->format('d M Y')}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <a href="{{ route('impersonate', [$user->id, 'true']) }}" class="btn btn-primary">Impersonate</a>--}}
                            <a href="{{url('admin/view-customer-transaction/'. $user->id)}}" class="btn btn-success">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
