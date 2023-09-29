@extends('Eticket.layout.app')
<style>
    .card-body h4 {
        text-align: center;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{$tenantCompanyName ?? env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/buses')}}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Load Schedule Seat(s)</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row three-row-grid">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">

                <div class="card">

                    <div class="card-body">
                        @if($emptySeatSchedules->total() > 1)
                            <h4> Set {{ $emptySeatSchedules->total() }} Schedule(s) Seat Tracker
                                <a href="{{url('e-ticket/generate-all-schedules-empty-seat')}}"
                                   onclick="confirm('Are you sure you want to generate all seat for all schedules?')"
                                   class="btn btn-danger btn-sm">Generate All Seat</a>

                            </h4>
                            <div class="container">
                                <div class="table-responsive">
                                    <table class="table yajra-datatable">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pick Up</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Number Plate</th>
                                            <th scope="col">Number Of Seat(s)</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($emptySeatSchedules as $index => $schedule)
                                            <tr>
                                                <th scope="row">{{$index + 1}}</th>
                                                <td>{{ $schedule->pickup?$schedule->pickup->location:"Not available" }}</td>
                                                <td>{{ $schedule->destination?$schedule->destination->location:'Not available' }}</td>
                                                <td>{{ $schedule->bus->bus_registration }}</td>
                                                <td>{{ $schedule->seats_available }}</td>
                                                <td>
                                                    <a href="{{url('e-ticket/generate-schedule-empty-seat/'.$schedule->id)}}"
                                                       onclick="confirm('Are you sure you want to generate seat for this schedule?')"
                                                       class="btn btn-danger btn-sm">Generate Seat</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    {!! $emptySeatSchedules->links() !!}
                                </div>
                            </div>
                        @else
                            <h4>Oops Nothing to see here ..</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
