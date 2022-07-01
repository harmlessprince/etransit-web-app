{{--<style>--}}
{{--    .receipt_column{--}}
{{--        display:flex;--}}
{{--        padding-bottom:20px;--}}
{{--    }--}}

{{--    .float-right{--}}
{{--        float: right;--}}
{{--        display: inline-block--}}


{{--    }--}}

{{--    .float-right:after {--}}
{{--        content: "";--}}
{{--        display: table;--}}
{{--        clear: both;--}}
{{--    }--}}
{{--    .container{--}}
{{--        width:100%;--}}

{{--    }--}}
{{--    .receipt_header {--}}
{{--        margin-left: 40%;--}}
{{--    }--}}
{{--    .receipt_validity{--}}
{{--        margin-left: 30%;--}}
{{--    }--}}
{{--    .barcode_receipt{--}}
{{--        margin-left: 20%;--}}
{{--    }--}}
{{--</style>--}}

{{--<div class="container">--}}
{{--    <div class="receipt_header receipt_column">--}}
{{--        <h3>Etransit</h3>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <div class="receipt_column">--}}
{{--            <div >--}}
{{--                <small>REFERENCE</small>--}}
{{--            </div>--}}
{{--            <div class="float-right">--}}
{{--                <small>{{$data['reference']}}</small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="receipt_column">--}}
{{--            <div >--}}
{{--                <small>PICKUP DATE</small>--}}
{{--            </div>--}}
{{--            <div class="float-right">--}}
{{--                <small>09:40</small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="receipt_column">--}}
{{--            <div>--}}
{{--                <small>Amount</small>--}}
{{--            </div>--}}
{{--            <div class="transport_amount float-right">--}}
{{--                <small> N 4000</small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="receipt_column">--}}
{{--            <div>--}}
{{--                <small>Type</small>--}}
{{--            </div>--}}
{{--            <div class="float-right">--}}
{{--                <small>One Way</small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="receipt_column">--}}
{{--            <div >--}}
{{--                <small>Discount</small>--}}
{{--            </div>--}}
{{--            <div class="transport_amount float-right">--}}
{{--                <small> 0%</small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        <div class="receipt_column">--}}
{{--            <div >--}}
{{--                <small>--}}
{{--                    Total--}}
{{--                </small>--}}
{{--            </div>--}}
{{--            <div class="price_box float-right" >--}}
{{--                <small>--}}
{{--                    N 10000--}}
{{--                </small>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        <div class="barcode_receipt receipt_column">--}}
{{--            <div class="barcode_img">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

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
    <table>
        <tr>
            <td>
                <small>Reference</small>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <small>{{$data['reference']}}</small>
            </td>
        </tr>
        <tr>
            <td>
                <small>Service Type</small>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <small>{{$data['service']}}</small>
            </td>
        </tr>
            <tr>
                <td><small>Amount</small></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><small>{{$data['plan']}}</small></td>
            </tr>
            <tr>
                <td><small>Payment Method</small></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><small>{{$data['payment_method']}}</small></td>
            </tr>
        <tr>
            <td><small>Pickup Date</small></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><small>{{$data['pickup_date']}}</small></td>
        </tr>
        <tr>
            <td><small>Pickup Time</small></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><small>{{$data['pickup_time']}}</small></td>
        </tr>

        <tr>
            <td><small>Days</small></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><small>{{$data['number_of_days']}}</small></td>
        </tr>

        <tr>
            <td><small>Total</small></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><small>{{number_format($data['total_payment'])}}</small></td>
        </tr>
    </table>


