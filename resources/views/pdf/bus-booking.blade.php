<!Doctype html>
<html>
<head>
    <style>
        body{margin-top:20px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }
        .invoice-container {
            padding: 1rem;
        }
        .invoice-container .invoice-header .invoice-logo {
            margin: 0.8rem 0 0 0;
            display: inline-block;
            font-size: 1.6rem;
            font-weight: 700;
            color: #2e323c;
        }
        .invoice-container .invoice-header .invoice-logo img {
            max-width: 130px;
        }
        .invoice-container .invoice-header address {
            font-size: 0.8rem;
            color: #9fa8b9;
            margin: 0;
        }
        .invoice-container .invoice-details {
            margin: 1rem 0 0 0;
            padding: 1rem;
            line-height: 180%;
            background: #f5f6fa;
        }
        .invoice-container .invoice-details .invoice-num {
            text-align: right;
            font-size: 0.8rem;
        }
        .invoice-container .invoice-body {
            padding: 1rem 0 0 0;
        }
        .invoice-container .invoice-footer {
            text-align: center;
            font-size: 0.7rem;
            margin: 5px 0 0 0;
        }

        .invoice-status {
            text-align: center;
            padding: 1rem;
            background: #ffffff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .invoice-status h2.status {
            margin: 0 0 0.8rem 0;
        }
        .invoice-status h5.status-title {
            margin: 0 0 0.8rem 0;
            color: #9fa8b9;
        }
        .invoice-status p.status-type {
            margin: 0.5rem 0 0 0;
            padding: 0;
            line-height: 150%;
        }
        .invoice-status i {
            font-size: 1.5rem;
            margin: 0 0 1rem 0;
            display: inline-block;
            padding: 1rem;
            background: #f5f6fa;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
        }
        .invoice-status .badge {
            text-transform: uppercase;
        }

        @media (max-width: 767px) {
            .invoice-container {
                padding: 1rem;
            }
        }


        .custom-table {
            border: 1px solid #e0e3ec;
        }
        .custom-table thead {
            background: #007ae1;
        }
        .custom-table thead th {
            border: 0;
            color: #ffffff;
        }
        .custom-table > tbody tr:hover {
            background: #fafafa;
        }
        .custom-table > tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }
        .custom-table > tbody td {
            border: 1px solid #e6e9f0;
        }


        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }

        .text-success {
            color: #00bb42 !important;
        }

        .text-muted {
            color: #9fa8b9 !important;
        }

        .custom-actions-btns {
            margin: auto;
            display: flex;
            justify-content: flex-end;
        }

        .custom-actions-btns .btn {
            margin: .3rem 0 .3rem .3rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <a href="index.html" class="invoice-logo">
                                        {{env('APP_NAME')}}
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <address class="text-right">
                                        55 Ogunlana Drive<br>
                                        Surulere, Lagos<br>
                                        +2347043274627
                                    </address>
                                </div>
                            </div>
                            <!-- Row end -->
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                    <div class="invoice-details">
                                        <address>
                                            {{$data['name']}}<br>
{{--                                            150-600 Church Street, Florida, USA--}}
                                        </address>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                    <div class="invoice-details">
                                        <div class="invoice-num">
                                            <div>{{$data['service']}} Invoice - #{{$data['reference']}}</div>
                                            <div>Departure Date - {{$data['tripSchedule']->departure_date->format('M-d-Y')}}</div>
                                            @if($data['tripType'] == 2)
                                            <div>Return Date - {{$data['tripSchedule']->return_date->format('M-d-Y')}}</div>
                                            @endif
                                            <div> Transaction Date - {{now()->format('M-d-Y')}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                        <div class="invoice-body">
                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table custom-table m-0">
                                            <thead>
                                            <tr>
                                                <th>Booking Details</th>
                                                <th colspan="2">Sub Total</th>
                                                <th>Grand Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {{$data['pickup']}} - {{$data['destination']}}<br>
                                                    @if($data['adultCount'] > 0)
                                                    {{$data['adultCount']}} Adult<br>
                                                    @endif
                                                    @if($data['childrenCount'] > 0)
                                                    {{$data['childrenCount']}} Child(ren)<br>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($data['adultCount'] > 0)
                                                        <h5 class="text-success">
                                                            <strong>
                                                               N {{$data['adultFare']}}
                                                            </strong>
                                                        </h5>
                                                    @endif
                                                    @if($data['childrenCount'] > 0)
                                                        <h5 class="text-success">
                                                            <strong>
                                                              N  {{$data['childFare']}}
                                                            </strong>
                                                        </h5>
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="2">
                                                </td>
                                                <td>
                                                    <p>

                                                    </p>
                                                    <h5 class="text-success"><strong>N{{number_format($data['totalAmount'])}}</strong></h5>
                                                </td>
                                            </tr>
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    Seat Number(s)--}}
{{--                                                </td>--}}
{{--                                                <td colspan="3">--}}
{{--                                                    @foreach($data['seatTrackers'] as $seatData)--}}
{{--                                                    {{$seatData->seat_position}} ,--}}
{{--                                                    @endforeach--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


