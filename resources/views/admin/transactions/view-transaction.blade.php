@extends('admin.layout.app')
<style>
    .bus_event{
        display: flex;
        justify-content: flex-end;
    }

    a:hover {
        text-decoration: none !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('e-ticket/buses')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Transaction</li>
                    </ol>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Transaction Information</h4>
                        <br>
                        <h6>Reference : {{$transaction->reference}}</h6>
                        <hr>
                        <h6>Amount : &#x20A6; {{number_format($transaction->amount)}}</h6>
                        <hr>
                        <h6>Status : {{$transaction->status}}</h6>
                        <hr>
{{--                        <h6>Transaction Type : {{$transaction->transaction_type}}</h6>--}}
{{--                        <hr>--}}
                        @if(!is_null($transaction->passenger_count))
                        <h6>Passenger Count : {{$transaction->passenger_count}}</h6>
                        <hr>
                        @endif
                        <h6>Payment Confirmation : {{$transaction->isConfirmed}}</h6>
                        <hr>
                        <h6>Description : {{$transaction->description}}</h6>
                        <hr>
                        <h6>Service : {{$transaction->service->name}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>User Information</h4>
                        <hr>
                        <h6>Full Name : {{ $transaction->user->full_name }}</h6>
                        <hr>
                        <h6>Email : {{ $transaction->user->email }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if(!is_null($transaction->schedule))
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Operator Information</h4>
                        <br>
                        <h6>Company's Name : {{$transaction->tenant->company_name}}</h6>
                        <hr>
                        <h6>Display Name :  {{$transaction->tenant->display_name}}</h6>
                        <hr>
                        <h6>Address : {{$transaction->tenant->address}}</h6>
                        <hr>
                    </div>
                </div>
            </div>
            @endif
            @if(!is_null($transaction->schedule))
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Schedule Information</h4>
                            <hr>
                            <h6>Pick Up : {{$transaction->schedule->pickup->location}}</h6>
                            <hr>
                            <h6>Destination : {{$transaction->schedule->destination->location}}</h6>
                            <hr>
                            <h6>Departure Date : {{$transaction->schedule->departure_date}}</h6>
                            <hr>
                            <h6>Departure Time : {{$transaction->schedule->departure_time}}</h6>
                            <hr>
                            <h6>Return Date : {{$transaction->schedule->return_date}}</h6>
                            <hr>
                            <h6>Terminal Name : {{$transaction->schedule->terminal->terminal_name}}</h6>
                            <hr>
                            <h6>Terminal Address : {{$transaction->schedule->terminal->terminal_address}}</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}
{{--            $.noConflict();--}}

{{--            var table = $('.yajra-datatable').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: "{{ route('e-ticket.fetch-tenant-buses') }}",--}}
{{--                columns: [--}}
{{--                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
{{--                    {data: 'car_type', name: 'car_type'},--}}
{{--                    {data: 'car_model', name: 'car_model'},--}}
{{--                    {data: 'car_registration', name: 'car_registration'},--}}
{{--                    {data: 'seater', name: 'seater'},--}}
{{--                    {data: 'wheels', name: 'wheels'},--}}

{{--                    {--}}
{{--                        data: 'action',--}}
{{--                        name: 'action',--}}
{{--                        orderable: true,--}}
{{--                        searchable: true--}}
{{--                    },--}}

{{--                ]--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}
@endsection
