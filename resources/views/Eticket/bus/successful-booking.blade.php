@extends('Eticket.layout.app')
<style>

</style>
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Booking Details</h4>
            </div>
            <div class="card-body">
                <h6>Name : {{$data['name']}}</h6>
                <hr>
                <h6>Phone Number : {{$data['customer']->phone}}</h6>
                <hr>
                <h6>From : {{$data['scheduleDetails']->pickup->location}}</h6>
                <hr>
                <h6>Destination : {{$data['scheduleDetails']->destination->location}}</h6>
                <hr>
                <h6>Departure Date : {{$data['scheduleDetails']->departure_date->format('Y-M-d')}}</h6>
                <hr>
                <h6>Departure Time : {{$data['scheduleDetails']->departure_time}}</h6>
                @if(!is_null($data['scheduleDetails']->return_date))
                <hr>
                <h6>Return Date : {{$data['scheduleDetails']->return_date->format('Y-M-d')}}</h6>
                @endif
                <hr>
                <h6>Adults Fare :&#8358;{{ $data['adultFare'] * $data['adultCount'] }} ({{$data['adultFare']." X ".$data['adultCount']}}) </h6>
                @if($data['childrenCount'] > 0)
                <hr>
                <h6>Children Fare :&#8358;{{ $data['childFare'] * $data['childrenCount'] }} ({{$data['childFare']." X ".$data['childrenCount']}}) </h6>
                <hr>
                @endif
                <h6>Bus Registration : {{$data['scheduleDetails']->bus->bus_registration}}</h6>
                <hr>
                <h6>Bus Model : {{$data['scheduleDetails']->bus->bus_model}}</h6>
                <hr>
                <h6>Bus Type : {{$data['scheduleDetails']->bus->bus_type}}</h6>
                <hr>
                <h3 class= "px-4"> &#8358;{{$data['totalAmount']}}</h3>


            </div>
            <div class="card-footer">
               <div class="px-4">
                   <a href="{{url('e-ticket/viewEachSchedule/'.$data['scheduleDetails']->id)}}" class="btn btn-primary">Back to schedule</a>
                   <a id="print"  onclick="printPDF()" class="btn btn-success">Print ticket</a>
               </div>
            </div>
        </div>
    </div>
</div>
<script>
        function printPDF(){

            var url = "{{url('e-ticket/printreceipt/'.$data['invoiceId'])}}";

            var receipt = window.open(url);
            receipt.focus();
            receipt.onafterprint = receipt.close;
            receipt.print();
        }
</script>
@endsection
