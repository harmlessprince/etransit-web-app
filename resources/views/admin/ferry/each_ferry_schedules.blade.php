@extends('admin.layout.app')
<style>
    .trip-status_off{
        background: red;
        color:white;
        padding:5px;
        border-radius: 4px;
    }
    .trip-status_on{
        background: green;
        color:white;
        padding:5px;
        border-radius: 4px;
    }
    .flexItem{
        display: flex;
        justify-content: space-between;
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
                        <li class="breadcrumb-item">Boat History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h5><span class="f-w-900 font-primary">{{$schedules[0]->ferry->name ?? 'Ferry Schedules'}}</span>  <span class="f-w-500 font-roboto">Schedule History</span></h5>
                                <br><br>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ferry Name</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">PickUp</th>
                                        <th scope="col">Ferry Type</th>
                                        <th scope="col">Amount (Adult)</th>
                                        <th scope="col">Amount (Child)</th>
                                        <th scope="col">No Of Passengers</th>
                                        <th scope="col">Trip Duration</th>
                                        <th scope="col">Trip Date</th>
                                        <th scope="col">Trip Time</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($schedules as $index => $schedule)
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>
                                                {{$schedule->ferry->name}}
                                            </td>
                                            <td>
                                                {{$schedule->destination->locations}}
                                            </td>
                                            <td>
                                                {{$schedule->pickup->locations}}
                                            </td>
                                            <td>{{$schedule->ferry_type->name}}</td>
                                            <td>{{$schedule->amount_adult}}</td>
                                            <td>{{$schedule->amount_children}}</td>
                                            <td>{{$schedule->number_of_passengers}}</td>
                                            <td>{{$schedule->trip_duration}}</td>
                                            <td>{{$schedule->event_date->format('Y F d')}}</td>
                                            <td>{{$schedule->event_time}}</td>
                                            <td>
                                                <a href="{{'/admin/view-ferry-booking-schedule/'.$schedule->id}}" class="btn btn-sm btn-success">View Bookings</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{$schedules->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
