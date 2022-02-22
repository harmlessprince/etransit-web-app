<style>
    .receipt_column{
        display:flex;
        padding-bottom:20px;
    }

    .float-right{
        float: right;
        display: inline-block


    }

    .float-right:after {
        content: "";
        display: table;
        clear: both;
    }
    .container{
        width:100%;

    }
    .receipt_header {
        margin-left: 40%;
    }
    .receipt_validity{
        margin-left: 30%;
    }
    .barcode_receipt{
        margin-left: 20%;
    }
</style>

<div class="container">
    <div class="receipt_header receipt_column">
        <h3>Etransit</h3>
    </div>
    <div>
        <div class="receipt_column">
            <div >
                <small>DEPARTURE DATE</small>
            </div>
            <div class="float-right">
                <small>{{$data['tripSchedule']->departure_date}}</small>
            </div>
        </div>
        @if($data['tripType'] == 2)
        <div class="receipt_column">
            <div >
                <small>RETURN DATE</small>
            </div>
            <div class="float-right">
                <small>{{$data['tripSchedule']->return_date}}</small>
            </div>
        </div>
        <div class="receipt_column">
            <div>
                <small>Type</small>
            </div>
            <div class="float-right">
                <small>Round Trip</small>
            </div>
        </div>
        @else
        <div class="receipt_column">
            <div>
                <small>Type</small>
            </div>
            <div class="float-right">
                <small>One Way</small>
            </div>
        </div>
        @endif

       @if($data['adultCount'] > 0)
        <div class="receipt_column">
            <div>
                <small>Adult</small>
            </div>
            <div class="transport_amount float-right">
                <small> {{$data['adultCount']}}</small>
            </div>
        </div>
        @endif

        @if($data['childrenCount'] > 0)
            <div class="receipt_column">
                <div>
                    <small>Adult</small>
                </div>
                <div class="transport_amount float-right">
                    <small> {{$data['childrenCount']}}</small>
                </div>
            </div>
        @endif
        @if($data['adultCount'] > 0)
            <div class="receipt_column">
                <div>
                    <small>Amount (Adult)</small>
                </div>
                <div class="transport_amount float-right">
                    <small> {{$data['adultFare']}}</small>
                </div>
            </div>
        @endif

        @if($data['childrenCount'] > 0)
            <div class="receipt_column">
                <div>
                    <small>Amount (Child)</small>
                </div>
                <div class="transport_amount float-right">
                    <small> {{$data['childFare']}}</small>
                </div>
            </div>
        @endif

        <div class="receipt_column">
            <div >
                <small>Discount</small>
            </div>
            <div class="transport_amount float-right">
                <small> 0%</small>
            </div>
        </div>
        <hr>
        <div class="receipt_column">
            <div >
                <small>
                    Total
                </small>
            </div>
            <div class="price_box float-right" >
                <small>
                     {{number_format($data['totalAmount'])}}
                </small>
            </div>
        </div>
        <hr>
        <div class="barcode_receipt receipt_column">
            <div class="barcode_img">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>
        </div>
    </div>
</div>





