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
            <small>DATE</small>
        </div>
        <div class="float-right">
            <small>09:40</small>
        </div>
    </div>
    <div class="receipt_column">
        <div>
            <small>Amount</small>
        </div>
        <div class="transport_amount float-right">
            <small> N 4000</small>
        </div>
     </div>
     <div class="receipt_column">
        <div>
            <small>Type</small>
        </div>
        <div class="float-right">
            <small>One Way</small>
        </div>
     </div>
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
                    N 10000
                </small>

            </div>
        </div>
         <hr>
        <div class="barcode_receipt receipt_column">
            <div class="barcode_img">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>
        </div>
    </div>
</div>





