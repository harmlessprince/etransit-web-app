@extends('admin.layout.app')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    var tranx = <?php echo $transactions; ?>;


    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable(tranx);

        var options = {

            title: 'Transaction',

            curveType: 'function',

            legend: { position: 'bottom' }

        };

        var chart = new google.visualization.LineChart(document.getElementById('linechart'));

        chart.draw(data, options);

    }

</script>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xl-7 box-col-12 xl-100">
                <div class="row dash-chart">
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="f-w-500 font-roboto">Total Transaction</span>
                                            <span class="font-primary f-w-700 ml-2">Bus Booking</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$busBookingTransaction}}</span></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="f-w-500 font-roboto">Total Transaction</span>
                                            <span class="font-primary f-w-700 ml-2">Train Booking</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$trainBookingTransaction}}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 box-col-12 xl-50">
                <div class="card o-hidden dash-chart">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    <span class="f-w-500 font-roboto">Total Transaction</span>
                                    <span class="font-primary f-w-700 ml-2">Ferry Booking</span>
                                </p>
                                <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$ferryBookingTransaction}}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row size-column">
            <div class="col-xl-7 box-col-12 xl-100">
                <div class="row dash-chart">
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="f-w-500 font-roboto">Total Transaction</span>
                                            <span class="font-primary f-w-700 ml-2">Car Hire</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$carHireBookingTransaction}}</span></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="f-w-500 font-roboto">Total Transaction</span>
                                            <span class="font-primary f-w-700 ml-2">Boat Cruise</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$boatCruiseBookingTransaction}}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 box-col-12 xl-50">
                <div class="card o-hidden dash-chart">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    <span class="f-w-500 font-roboto">Total Transaction</span>
                                    <span class="font-primary f-w-700 ml-2">Parcel</span>
                                </p>
                                <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$parcelBookingTransaction}}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 box-col-12 xl-50">
                <div class="card o-hidden dash-chart">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    <span class="f-w-500 font-roboto">Total Transaction</span>
                                    <span class="font-primary f-w-700 ml-2">Tour Packages</span>
                                </p>
                                <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$tourBookingTransaction}}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 box-col-12 xl-50">
                <div class="card o-hidden dash-chart">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    <span class="f-w-500 font-roboto">Total Transaction</span>
                                    <span class="font-primary f-w-700 ml-2">All Packages</span>
                                </p>
                                <h4 class="f-w-500 mb-0 f-26">&#8358;<span class="counter">{{$allTransactions}}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <hr>
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xl-7 box-col-12 xl-100">
                <div class="row dash-chart">
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="f-w-500 font-roboto">Total Bus(es)</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{$busCount}}</span></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p>
                                            <span class="f-w-500 font-roboto">Total Schedule(s)</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{$schedulesCount}}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 box-col-12 xl-50">
                <div class="card o-hidden dash-chart">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    <span class="f-w-500 font-roboto">Number Of Operator(s)</span>
                                </p>
                                <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{$operatorCount}}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="container-fluid">
        <h4>Schedules</h4>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Recent Bus Schedule(s)</h5>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Terminal</th>
                                <th scope="col">PickUp</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Amount (Adult)</th>
                                <th scope="col">Departure Date</th>
                                <th scope="col">Registration</th>
                                <th scope="col">Operator</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $index => $schedule)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$schedule->terminal?$schedule->terminal->terminal_name:'--'}}</td>
                                <td>{{$schedule->pickup?$schedule->pickup->location:'--'}}</td>
                                <td>{{$schedule->destination?$schedule->destination->location:'--'}}</td>
                                <td>{{number_format($schedule->fare_adult)}}</td>
                                <td>{{$schedule->departure_date->format('d F Y')}}</td>
                                <td>{{$schedule->bus?$schedule->bus->bus_registration:'--'}}</td>
                                <td>{{$schedule->bus?$schedule->bus->tenant->display_name:'--'}}</td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <h4>Total Transaction(s)</h4>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div id="linechart" style="width: 100%; height: 500px"></div>
            </div>
        </div>
    </div>
<hr>
@endsection
