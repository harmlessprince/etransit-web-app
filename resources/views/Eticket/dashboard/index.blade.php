@extends('Eticket.layout.app')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    var tranx = <?php echo $transactions; ?>;


    google.charts.load('current', {'packages': ['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable(tranx);

        var options = {

            title: 'Transaction',

            curveType: 'function',

            legend: {position: 'bottom'}

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
                    <h3>{{$tenantCompanyName  ?? env('APP_NAME')}}</h3>
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
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row size-column">
            <div class="col-md-12">
                <div class="row dash-chart">
                    <div class="col-xl-6 box-col-6 col-md-6">
                        <div class="card o-hidden">
                            <div class="card-header card-no-border">
                                <div class="media">
                                    <div class="media-body">
                                        <p><span class="f-w-500 font-roboto">Total ( Car Hire Transaction )</span></p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span
                                                class="counter">{{$carHireTransaction}}</span></h4>
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
                                        <p><span class="f-w-500 font-roboto">Total (Co-Traveller Transaction )</span>
                                        </p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span
                                                class="counter">{{$busBookingTransaction}}</span></h4>
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
                                        <p><span class="f-w-500 font-roboto">Total Transactions ( Today ) </span></p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span
                                                class="counter">{{$todayTransaction}}</span></h4>
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
                                        <p><span class="f-w-500 font-roboto">Total Transactions ( All Time ) </span></p>
                                        <h4 class="f-w-500 mb-0 f-26">&#8358;<span
                                                class="counter">{{$totalTransaction}}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h4>Total Transaction(s)</h4>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                <div id="linechart" style="width: 100%; height: 500px"></div>
            </div>
        </div>
    </div>
@endsection
