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
    .car_details
    {
        color: rgba(182, 181, 181, 0.6);
    }
    a {
        text-decoration:none !important;
    }

</style>
@section('content')
    <section style="height: 226px;background: url(&quot;../../new-assets/img/Rectangle%2015%20(2).png&quot;) center / cover no-repeat;">
        <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
            <div class="container d-md-flex justify-content-md-center align-items-md-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="color: var(--bs-white);text-align: center;"><strong>Hire A Vehicle</strong></h1>
                        <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Loren ipsum dolor</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
            <div class="row">
                    <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3"></div>
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000" id="carousel-t" style="min-height: 0px;margin-top: 0px;padding: 22px;">
                            <div class="carousel-inner" style="border-right-style: none;">
                                @foreach($car->car_images as $index => $image)
                                    <div class="carousel-item @if($index == 0 )active @endif" style="border-radius: 30px;border-style: none;border-right-style: none;margin-right: 0px;background: url(&quot;assets/img/Rectangle%202.1.png&quot;) center / cover no-repeat;">
                                        <img class="img-fluid w-100 d-block" src="{{$image->path}}" style="border-radius: 30px;border-style: none;border-right-style: none;">
                                    </div>
                                @endforeach
                            </div>
                            <div><a class="carousel-control-prev" href="#carousel-t" role="button" data-bs-slide="prev" style="margin-left: 60px;"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-t" role="button" data-bs-slide="next" style="margin-right: 60px;"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                            <ol class="carousel-indicators">
                                @foreach($car->car_images as $index => $image)
                                    <li data-bs-target="#carousel-t" data-bs-slide-to="{{$index}}" @if($index == 0 )class="active" @endif></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
            </div>
        <div class="row">
            <div class="col-md-3 col-xl-3 col-sm-3 col-lg-3"></div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Description</h4>
                </div>
                <div style="justify-content: center;">
                    <p>{!! $car->description !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Name</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->car_name !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Registration</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->car_registration !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Transmission</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->transmission !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Model</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->model_year !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Capacity</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->capacity !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Air Conditioning</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->air_conditioning == 1 ? 'Functioning' : "Not Functioning" !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Type</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->cartype->name !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <h4 class="car_details">Car Class</h4>
                </div>
                <div style="display: flex; justify-content: center;">
                    <p>{!! $car->carclass->name !!}</p>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <a href="{{url('select/car-plan/'.$car->id)}}">
                        <button class="btn  d-md-flex" type="button"
                                style="color: rgb(255,255,255);
                                                   background: rgb(52,63,95);
                                                   text-align: center;">
                            Book Now
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection
