@extends('layouts.app')
<style>
    .date_picker_box{
        background: white;
        padding:20px;
        margin-top:90px;
        box-shadow: 1px 2px 1px 2px rgba(182, 181, 181, 0.6);
        border-radius: 10px;
        display:grid;
        grid-template-columns: repeat(2 , 1fr);
        margin-bottom: 100px;
    }
    #date , #time{
        border:none ;
        border-bottom: 1px solid #DC6513 !important;
        outline:none;
    }
    .pick_btn button{
        background: #021037;
        padding:10px;
        color:#fff;
        border-radius: 10px;
        border: 1px solid #021037;
    }
    .pick_btn button:hover{
        background:#DC6513;
        border:1px solid #DC6513;
    }
    .car_hire_info{
        text-align: center;
        background: #fff;

    }
    .car_info{
        font-size: 25px;
        color:#021037;
    }
</style>
@section('content')
<div class="container">
    <div class="date_picker_box">
       <div class="date_picker_form">
           <div>
               <form method="POST" action="{{url('plan/'.$findPaymentOption->id)}}">
                   @csrf
                   <div class="form-group">
                       <label for="date">Pick Up Date</label>
                       <input type="date" name="date" id="date" class="form-control" required/>
                   </div>
                   <div class="form-group">
                       <label for="time">Pick Up Time</label>
                       <input type="time" name="time" id="time" class="form-control" required/>
                   </div>
                   <div class="pick_btn">
                       <button>Add Pick Up Information</button>
                   </div>
               </form>
           </div>
       </div>
        <div class="car_hire_info">

            <div class="car_info">
                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                <small>Rental Plan :{{$findPaymentOption->plan}}</small>
            </div>
{{--            <div class="car_info">--}}
{{--                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>--}}
{{--                <small>Class :{{$findPaymentOption->car->car_class}}</small>--}}
{{--            </div>--}}
            <div class="car_info">
                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                <small>Rental Fare :&#8358; {{$findPaymentOption->amount}}</small>
            </div>
            @if(!empty($findPaymentOption->extra_hour))
            <div class="car_info">
                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                <small>Extra Hour : &#8358; {{$findPaymentOption->extra_hour}}</small>
            </div>
            @endif
{{--            <div class="car_info">--}}
{{--                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>--}}
{{--                <small>Type :{{$findPaymentOption->car->car_type}}</small>--}}
{{--            </div>--}}

            @if(!empty($findPaymentOption->extra_hour))
            <div class="car_info">
                <img src="{{asset('images/icons/plan_options.png')}}" alt="plan-icon"/>
                <small>Daily rental is for a period of 12 hours</small>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
