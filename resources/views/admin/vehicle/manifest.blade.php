@extends('admin.layout.app')
<style>
    input{
        border:0 !important;
        border-bottom: 1px solid gray ! important;

    }

    input:focus{
        outline:none !important;
    }
    .align-text{
        text-align: center;
    }
    .three-row-grid{
        display:flex;
        justify-content: space-between;
    }
    .add_bus_btn{
        display: flex;
        justify-content: flex-end;
    }
    .space-left{
        margin-left: 10px;
        margin-bottom:10px;
    }
    a{
        text-decoration: none !important;
    }
    .booked_status{
        background: #5cdd5c;
        color: white;
        padding:10px;
    }

</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{ env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Bus</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="row three-row-grid">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>&#8358; {{number_format($tranx)}}</h1>
                            <h6>Actual Return</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>&#8358; {{number_format($manifests[0]->schedule->fare_adult ?? 0)}}</h1>
                            <h6>Adult Fare</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>&#8358; {{number_format($manifests[0]->schedule->fare_children ?? 0)}}</h1>
                            <h6>Children Fare</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <div class="align-text">
                            <h1>{{$bookings}}</h1>
                            <h6>Total Bookings</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                <div class="add_bus_btn">
                    <div class="space-left">
{{--                        <a href="" class="btn btn-success">Download Manifest</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Passenger Name</th>
                        <th>Booked Status</th>
                        <th>Gender</th>
                        <th>Age Range</th>
                        <th>Booked By</th>
                        <th>Seat Position</th>
{{--                        <th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($manifests as $index => $manifest)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$manifest->full_name}}</td>
                        <td>
                            @if($manifest->seat_position->booked_status == 2)
                               <span class="booked_status">Booked</span>
                            @endif
                        </td>
                        <td>{{$manifest->gender}}</td>
                        <td>{{$manifest->passenger_age_range}}</td>
                        <td>{{$manifest->user->email}}</td>
                        <td>{{$manifest->seat_position->seat_position}}</td>
{{--                        <td>--}}
{{--                            <a href="" class="btn btn-danger">View Transaction</a>--}}
{{--                        </td>--}}
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
