@extends('layouts.app')
<style>

    .select_payment {
        margin-left: 30px;
        margin-top: 20px;
    }

    .select_payment {
        padding: 10px;
        color: #DC6513;
        border: 1px solid #DC6513;
        width: 250px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
    }

    #cash_payment_option {
        margin-top: 20px;

    }

    .cash_payment {
        color: #fff;

    }

    #online_payment {

    }

    .parcel_receipt_box {
        background: #FFFFFF;
        margin-top: 10px;
        margin-left: 30px;
        margin-right: 30px;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 5px 5px 5px 5px rgba(212, 227, 241, 0.66);
    }

    .parcel_shipping_cost {
        display: flex;
        justify-content: space-between;
    }

    .payment_options, .payment_button {
        margin-left: 30px;
        margin-top: 20px;
    }

    .payment_button {
        background: #DC6513;
        padding: 10px;
        color: white;
        border: 1px solid #DC6513;
        width: 250px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
    }

    .payment_button:hover {
        background: #021037;
        border: 1px solid #DC6513;

    }

    button, input[type="submit"], input[type="reset"] {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }
</style>
@section('content')
    <div class="payment-box container row col-md-12">
        <div class="col-md-2"></div>
        <div class="payment col-md-4">
            <h3>PAYMENT</h3>
            <p>Hire Our vehicles for your various trips and occasion </p>
            <h5>SELECT PAYMENT METHOD</h5>
            <div class="payment_button">
                <button id="credpal_payment" type="button">Pay With CredPal</button>
            </div>


            <div class="payment_button" id="online_payment">
                <form method="POST" action="{{ route('pay') }}" id="paymentForm">
                    {{ csrf_field() }}

                    {{--                    <input type="hidden" name="name" value="{{auth()->user()->full_name}}" placeholder="Name" />--}}
                    {{--                    <input type="hidden" name="email" type="email" value="{{auth()->user()->email}}" placeholder="Your Email" />--}}
                    {{--                    <input type="hidden" name="phone" type="tel" value="{{auth()->user()->phone_number}}" placeholder="Phone number" />--}}
                    {{--                    <input type="hidden" name="amount" value="{{$totalFare}}"/>--}}
                    {{--                    <input type="hidden" name="service" value="{{$fetchScheduleDetails->service->name}}" />--}}
                    {{--                    <input type="hidden" name="service_id" value="{{$fetchScheduleDetails->service->id}}" />--}}
                    {{--                    <input type="hidden" name="schedule_id" value="{{$fetchScheduleDetails->id}}" />--}}
                    {{--                    <input type="hidden" name="childrenCount" value="{{$childrenCount}}"/>--}}
                    {{--                    <input type="hidden" name="adultCount" value="{{$adultCount}}"/>--}}
                    <input type="submit" value="Buy Ticket"/>
                </form>
            </div>
            <div class="payment_button" id="cash_payment_option">
                <form method="POST" action="{{ route('parcel-cash-payment') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="amount" value="{{$amountTotal}}"/>
                    <input type="hidden" name="delivery_parcel_id" value="{{$deliveryParcelId}}"/>
                    <input type="submit" value="Pay With Cash"/>
                </form>
            </div>
            <div class="payment_options">
                <img src="{{asset('images/icons/mastercard.png')}}" width="70" height="50"/>
                <img src="{{asset('images/icons/visa.png')}}" width="70" height="50"/>
            </div>
        </div>
        <div class="receipt-box col-md-6">
            <div class="parcel_receipt_box">
                <div class="parcel_receipt_header">
                    <div class="parcel_header_summary">
                        <h4>Summary</h4>
                    </div>
                    <hr>
                    <div class="parcel_shipping_cost">
                        <h5>Shipping</h5>
                        <h5>&#x20A6; {{number_format($amountTotal)}}</h5>
                    </div>
                    <div class="parcel_shipping_cost">
                        <h5>Tax</h5>
                        <h5>0</h5>
                    </div>
                    <div class="parcel_shipping_cost">
                        <h5>Discount</h5>
                        <h5>0%</h5>
                    </div>
                    <hr>
                    <div class="parcel_shipping_cost">
                        <h5>Total Price</h5>
                        <h5>&#x20A6; {{number_format($amountTotal)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $properties = json_encode([
        "name" => auth()->user()->full_name,
        "email" => auth()->user()->email,
        "phone" => auth()->user()->phone_number,
        "delivery_parcel_id" => $deliveryParcelId
    ], JSON_THROW_ON_ERROR);
    ?>
    <script>
        const button = document.getElementById('credpal_payment');

        button.addEventListener('click', function () {
            payWithCredPal();
        });


        function payWithCredPal() {
            let val = <?php echo $properties; ?>;
            const checkout = new Checkout({
                key: 'ad5ba355-d8e4-4e57-844b-6572d2442880', // Your Key
                amount: {{ $amountTotal }},
                product: val,
                onClose: function () {
                    console.log('Widget closed');
                },
                onLoad: function () {
                    console.log('Widget loaded successfully');
                },
                onError: function (error) {
                    console.log(error);
                },
                onSuccess: function (data) {
                    success(data);
                    checkout.close();
                },
            });
            checkout.setup();
            return checkout.open();
        }

        function success(data) {
            console.log(data); // callback function
        }


    </script>
@endsection
