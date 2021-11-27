@extends('layouts.app')
<style>
    .plan_container
    {
        display:grid;
        grid-template-columns: repeat(3 , 1fr);
        column-gap: 50px;
    }
    .plan_box
    {
        background:#FE6700;
        /*#fff;*/
        padding:20px;
        margin-top:40px;
        box-shadow: 1px 2px 1px 2px rgba(182, 181, 181, 0.6);
        border-radius: 10px;
    }

    .plan_header , .plan_header_text ,.plan_pice ,.plans_options
    {
        display:grid;
        text-align: center;
    }
    .plan_header_text
    {
        padding:20px;
    }
    .plan_pice
    {
        color:#000000;
    }
    .plans_options
    {
        font-size:20px;
    }
    .plans_options small
    {

        margin-left:10px;
    }
    .payment_box
    {
        text-align: center;
        margin-top:40px;
    }
    .payment_box button
    {
        border:1px solid rgba(182, 181, 181, 0.6);
        padding:10px;
        border-radius: 5px;
        background:#FFFFFF;
    }
    .payment_box button:hover
    {
        background:#FE6700;
        color:white;
        border:1px solid white;
        cursor:pointer;
    }
    .plan_header h4 , span , .plan_header_text small , .plan_pice h2 , .plans_options small
    {
        color:white;
    }
</style>
@section('content')
<div class="container">


    <div class="plan_container">

        @for($i =0 ; $i < count($car->plans) ; $i++)
            <div class="plan_box">
                <div class="plan_header">
                    <div>
                        <h4>{{Ucfirst($car->plans[$i]->plan)}}</h4>
                        <span></span>
                    </div>
                </div>
                <div class="plan_header_text">
                    <small>
                        {{ \Illuminate\Support\Str::limit($car->description, $limit = 150, $end = '...') }}
                    </small>
                </div>
                <div class="plan_pice">
                    <h2><sup>&#8358; </sup> {{number_format($car->plans[$i]->amount)}}</h2>
                </div>
                <div class="plans_options">
                    <div>
                        <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>
                        <small>{{Ucfirst($car->car_class)}}</small>
                    </div>
                    @if(!empty($car->plans[$i]->extra_hour))
                    <div>
                        <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>
                        <small>Extra Hour :<sup>&#8358; </sup>  {{number_format($car->plans[$i]->extra_hour)}}</small>
                    </div>
                    @endif
                </div>
                <div class="payment_box">
                    <a href="{{url('/select/plan/'. $car->plans[$i]->id)}}">
                        <button>PICK A PLAN</button>
                    </a>
                </div>
            </div>
        @endfor
{{--            <div class="plan_box">--}}
{{--            <div class="plan_header">--}}
{{--                <div>--}}
{{--                    <h4>South West</h4>--}}
{{--                    <span></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="plan_header_text">--}}
{{--                <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
{{--                    sed do eiusmod tempor--}}
{{--                    incididunt ut labore et dolore magna aliqua.</small>--}}
{{--            </div>--}}
{{--            <div class="plan_pice">--}}
{{--                <h2><sup>&#8358; </sup> {{number_format($car->sw_fare)}}</h2>--}}
{{--            </div>--}}
{{--            <div class="plans_options">--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>{{Ucfirst($car->car_class)}}</small>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>Extra Hour :<sup>&#8358; </sup>  {{number_format(($car->extra_hour))}}</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="payment_box">--}}
{{--                <a href="{{url('/car-hire/pay/'. $car->id . '/south-west')}}">--}}
{{--                    <button>PROCEED TO PAYMENT</button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--            <div class="plan_box">--}}
{{--            <div class="plan_header">--}}
{{--                <div>--}}
{{--                    <h4>South South</h4>--}}
{{--                    <span></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="plan_header_text">--}}
{{--                <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
{{--                    sed do eiusmod tempor--}}
{{--                    incididunt ut labore et dolore magna aliqua.</small>--}}
{{--            </div>--}}
{{--            <div class="plan_pice">--}}
{{--                <h2><sup>&#8358; </sup> {{number_format($car->ss_fare)}}</h2>--}}
{{--            </div>--}}
{{--            <div class="plans_options">--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>{{Ucfirst($car->car_class)}}</small>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>Extra Hour :<sup>&#8358; </sup>  {{number_format(($car->extra_hour))}}</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="payment_box">--}}
{{--                <a href="{{url('/car-hire/pay/'. $car->id . '/south-south')}}">--}}
{{--                    <button>PROCEED TO PAYMENT</button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--            <div class="plan_box">--}}
{{--            <div class="plan_header">--}}
{{--                <div>--}}
{{--                    <h4>South East</h4>--}}
{{--                    <span></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="plan_header_text">--}}
{{--                <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
{{--                    sed do eiusmod tempor--}}
{{--                    incididunt ut labore et dolore magna aliqua.</small>--}}
{{--            </div>--}}
{{--            <div class="plan_pice">--}}
{{--                <h2><sup>&#8358; </sup> {{number_format($car->se_fare)}}</h2>--}}
{{--            </div>--}}
{{--            <div class="plans_options">--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>{{Ucfirst($car->car_class)}}</small>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>Extra Hour :<sup>&#8358; </sup>  {{number_format(($car->extra_hour))}}</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="payment_box">--}}
{{--                <a href="{{url('/car-hire/pay/'. $car->id . '/south-east')}}">--}}
{{--                    <button>PROCEED TO PAYMENT</button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--            <div class="plan_box">--}}
{{--            <div class="plan_header">--}}
{{--                <div>--}}
{{--                    <h4>North Central</h4>--}}
{{--                    <span></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="plan_header_text">--}}
{{--                <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
{{--                    sed do eiusmod tempor--}}
{{--                    incididunt ut labore et dolore magna aliqua.</small>--}}
{{--            </div>--}}
{{--            <div class="plan_pice">--}}
{{--                <h2><sup>&#8358; </sup>{{number_format($car->nc_fare)}}</h2>--}}
{{--            </div>--}}
{{--            <div class="plans_options">--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>{{Ucfirst($car->car_class)}}</small>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <img src="{{asset('images/icons/plan_options_white.png')}}" alt="plan-icon"/>--}}
{{--                    <small>Extra Hour :<sup> &#8358;</sup>  {{number_format(($car->extra_hour))}}</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="payment_box">--}}
{{--                <a href="{{url('/car-hire/pay/'. $car->id . '/north-central')}}">--}}
{{--                    <button>PROCEED TO PAYMENT</button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

</div>


@endsection
