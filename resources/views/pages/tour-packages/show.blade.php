@extends('layouts.app')
@section('content')
<section style="height: 226px;background: url('{{ asset('images/bg/boat_cruise.png')}}')center / cover no-repeat;">
    <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
        <div class="container d-md-flex justify-content-md-center align-items-md-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color: var(--bs-white);text-align: center;"><strong>Tour Packages&nbsp;</strong></h1>
                    <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Loren ipsum dolor</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="margin: 20px;border-style: none;margin-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 flex-grow-0 flex-shrink-1 flex-wrap" style="box-shadow: 1px 1px 6px 1px rgb(189,189,190);padding-top: 15px;padding-bottom: 15px;border-radius: 9px;min-height: 500px;max-height: 600px;margin-bottom: 10px;">
                <div class="row">
                    <div class="col">
                        <p style="margin-bottom: 0PX;font-size: 14px;"><strong>FILTER SEARCH</strong></p>
                    </div>
                    <div class="col-md-auto"><a href="#" style="color: var(--bs-yellow);">Clear all</a></div>
                </div>
                <hr>
                <div class="row" style="margin-bottom: 11px;">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Star Rating</strong></p>
                    </div>
                    <div class="col" style="text-align: right;">
                        <div class="dropdown" style="height: 24px;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: var(--bs-dark);background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">Reset</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td><span><i class="fa fa-star" style="color: var(--bs-yellow);--bs-warning: #ffc107;--bs-warning-rgb: 255,193,7;"></i></span><span><i class="fa fa-star" style="color: var(--bs-yellow);padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: var(--bs-yellow);"></i></span><span><i class="fa fa-star" style="color: var(--bs-yellow);padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: #afafb0;"></i></span></td>
                                    <td style="text-align: right;color: #afafb0;">&amp; Above</td>
                                </tr>
                                <tr>
                                    <td><span><i class="fa fa-star" style="color: var(--bs-yellow);"></i></span><span><i class="fa fa-star" style="color: var(--bs-yellow);padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: var(--bs-yellow);"></i></span><span><i class="fa fa-star" style="color: #afafb0;padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: #afafb0;"></i></span></td>
                                    <td style="text-align: right;color: #afafb0;">&amp; Above</td>
                                </tr>
                                <tr>
                                    <td><span><i class="fa fa-star" style="color: var(--bs-yellow);"></i></span><span><i class="fa fa-star" style="color: var(--bs-yellow);padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: #afafb0;"></i></span><span><i class="fa fa-star" style="color: #afafb0;padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: #afafb0;"></i></span></td>
                                    <td style="text-align: right;color: #afafb0;">&amp; Above</td>
                                </tr>
                                <tr>
                                    <td><span><i class="fa fa-star" style="color: var(--bs-yellow);"></i></span><span><i class="fa fa-star" style="color: #afafb0;padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: #afafb0;"></i></span><span><i class="fa fa-star" style="color: #afafb0;padding-right: 5px;padding-left: 5px;"></i></span><span><i class="fa fa-star" style="color: #afafb0;"></i></span></td>
                                    <td style="text-align: right;color: #afafb0;">&amp; Above</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Price Range</strong></p>
                    </div>
                    <div class="col" style="text-align: right;">
                        <div class="dropdown" style="height: 24px;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: var(--bs-dark);background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">Reset</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><input class="form-range" type="range"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Price Range</strong></p>
                    </div>
                    <div class="col" style="text-align: right;">
                        <div class="dropdown" style="height: 24px;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: var(--bs-dark);background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">Reset</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2" style="color: #afafb0;">Wonderful</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1" style="color: #afafb0;">Very Good</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-4"><label class="form-check-label" for="formCheck-4" style="color: #afafb0;">Good</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3" style="color: #afafb0;">Pleasant</label></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6 col-md-9" id="cruisedisplay" style="padding-left: 0px;padding-right: 0px;">
                <div class="row" id="optionline-1" style="padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 15px;margin-left: 0px;margin-right: 0px;">
                    <div class="col" style="background: #eeeeee;border-right: 1px solid #bebebe ;">
                        <div class="dropdown" id="targetcenter-1" style="border-style: none;background: #eeeeee;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgb(238,238,238);border-style: none;">&nbsp;Location&nbsp;&nbsp;</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: center;">Lagos<span style="color: rgb(146,144,144);margin-left: 5px;">Ikeja</span></p>
                    </div>
                    <div class="col" style="background: #eeeeee;">
                        <div class="dropdown" style="border-style: none;background: #eeeeee;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgb(238,238,238);border-style: none;"><i class="fa fa-calendar-o"></i>&nbsp; Check in</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: left;margin-bottom: 0px;">&nbsp; &nbsp;June 28, 2021</p>
                        <p style="color: rgb(121,122,122);">&nbsp; &nbsp;Tuesday</p>
                    </div>
                    <div class="col" style="background: #eeeeee;border-right: 1px solid #bebebe ;">
                        <div class="dropdown" style="border-style: none;background: #eeeeee;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgb(238,238,238);border-style: none;"><i class="fa fa-calendar-o"></i>&nbsp; Checkout</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: left;margin-bottom: 0px;">&nbsp; &nbsp;June 28, 2021</p>
                        <p style="color: rgb(121,122,122);">&nbsp; &nbsp;Tuesday</p>
                    </div>
                    <div class="col" style="background: #eeeeee;">
                        <div class="dropdown" id="targetcenter-2" style="border-style: none;background: #eeeeee;text-align: center;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgb(238,238,238);border-style: none;">No. of Adult</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: center;margin-bottom: 0px;">4</p>
                    </div>
                    <div class="col" style="background: #eeeeee;">
                        <div class="dropdown" id="targetcenter-3" style="border-style: none;background: #eeeeee;text-align: center;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgb(238,238,238);border-style: none;">No. of Chidren</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: center;margin-bottom: 0px;">1</p>
                    </div>
                    <div class="col mx-auto" style="background: #eeeeee;">
                        <div class="dropdown" id="targetcenter-4" style="border-style: none;background: #eeeeee;text-align: center;"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="color: rgb(136,136,136);background: rgb(238,238,238);border-style: none;">Room</button>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </div>
                        <p style="font-weight: bold;text-align: center;margin-bottom: 0px;">1</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="width: 388px;height: 189.031px;">
                        <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000" id="carousel-t" style="min-height: 0px;margin-top: 0px;padding: 22px;">
                            <div class="carousel-inner" style="border-right-style: none;">
                                @foreach($tour->tourimages as $index => $img)
                                <div class="carousel-item @if($index == 0)active @endif" style="border-radius: 30px;border-style: none;border-right-style: none;margin-right: 0px;background: url(&quot;assets/img/Rectangle%202.1.png&quot;) center / cover no-repeat;"><img class="img-fluid w-100 d-block" src="{{$img->path}}" style="border-radius: 30px;border-style: none;border-right-style: none;"></div>
                                @endforeach
                            </div>
                            <div><a class="carousel-control-prev" href="#carousel-t" role="button" data-bs-slide="prev" style="margin-left: 60px;"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-t" role="button" data-bs-slide="next" style="margin-right: 60px;"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                            <ol class="carousel-indicators">
                                @foreach($tour->tourimages as $index => $img)
                                <li data-bs-target="#carousel-t" data-bs-slide-to="{{$index}}" class="active"></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row" id="overviewlayout">
                    <div class="col"><span style="margin-right: 95px;margin-left: 42px;font-size: 20px;font-weight: bold;">Overview</span><span style="font-size: 20px;font-weight: bold;color: var(--bs-gray);">Review</span></div>
                </div>
                <div class="row d-inline-flex justify-content-md-center align-items-md-center" id="widthrow" style="padding: 40px;padding-top: 19px;">
                    <div class="col-md-4" style="height: 60px;width: 181.75px;">
                        <div class="row" id="view-1" style="border-radius: 17px;height: 62px;border: 4px solid var(--bs-gray-300);margin-right: -12px;">
                            <div class="col text-center align-self-center" style="margin-right: 0px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-clock-fill fs-1" style="font-size: 37px;color: #fd3e14;border-radius: 12px;background: var(--bs-gray-300);margin-top: -6px;border: 8px solid var(--bs-gray-300);">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                </svg></div>
                            <div class="col">
                                <p class="text-center" style="color: rgb(134,139,145);margin-top: 3px;margin-bottom: -6px;">DURATION</p>
                                <p style="text-align: center;font-weight: bold;">4 Day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="width: 190px;margin-left: 17px;border-color: var(--bs-gray-300);">
                        <div class="row" id="view-2" style="border-radius: 17px;border: 4px solid rgb(206,212,218);height: 62px;">
                            <div class="col text-center align-self-center" style="margin-right: 0px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-clock-fill fs-1" style="font-size: 37px;color: #fd3e14;border-radius: 12px;background: var(--bs-gray-300);margin-top: -6px;border: 8px solid var(--bs-gray-200);">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                </svg></div>
                            <div class="col">
                                <p class="text-center" style="color: rgb(134,139,145);margin-top: 3px;margin-bottom: -6px;">DURATION</p>
                                <p style="text-align: center;font-weight: bold;">4 Day</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="color: var(--bs-gray-500);padding-left: 15px;padding-right: 15px;">
                           {!! $tour->description !!}
                        </p>
                    </div>
                </div>
                <div class="row" id="overviewlayout-1" style="margin-top: 10px;">
                    <div class="col"><span style="margin-right: 95px;margin-left: 19px;font-size: 20px;font-weight: bold;">Price per trip</span></div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive" style="padding-left: 10px;padding-right: 10px;">
                            <form id="payment_plan" method="post" action="{{url('/tour/'.$tour->id.'/payment-plan/'.$service->id)}}">
                                @csrf
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input radioInput" type="radio" value="{{$tour->amount_regular}}" name="amount"  id="formCheck-5">
                                                <label class="form-check-label" for="formCheck-5">Regular</label>
                                            </div>
                                        </td>
                                        <td style="font-weight: bold;">&#x20A6;{{number_format($tour->amount_regular)}}<sub style="color: var(--bs-gray-500);">&nbsp;per trip</sub></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input tradioInput" type="radio" value="{{$tour->amount_standard}}" name="amount" id="formCheck-6">
                                                <label class="form-check-label" for="formCheck-6">Standard</label>
                                            </div>
                                        </td>
                                        <td style="font-weight: bold;">&#x20A6;{{number_format($tour->amount_standard)}}<sub style="color: var(--bs-gray-500);">&nbsp;Per trip</sub></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row" id="overviewlayout-2" style="margin-top: 10px;">
                    <div class="col"><span style="margin-right: 95px;margin-left: 19px;font-size: 20px;font-weight: bold;">Popular boat cruise</span></div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col">
                        <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000" data-bs-pause="false" id="carousel-top-margin">
                            <div class="carousel-inner">

                                <div class="carousel-item active" style="background: #ffffff;">
                                    <div class="row g-0 slider-row">
                                        @for($i =0 ; $i < 4 ; $i++)
                                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 offset-sm-0">
                                            <div class="card-group">
                                                <div class="card" style="margin: 10px;border-radius: 10px;margin-right: 10px;border-style: none;box-shadow: 1px 1px 10px 1px rgb(204,205,205);">
                                                    <img class="img-fluid card-img-top w-100 d-block" style="border-top-left-radius: 7px;border-top-right-radius: 7px;" src="{{asset('new-assets/img/tp3.png')}}">
                                                    <div class="card-img-overlay text-end" style="border-style: solid;color: rgba(33,37,41,0);">
                                                        <p style="color: var(--bs-white);font-size: 10px;margin-bottom: 1px;"><strong>Starting from</strong></p>
                                                        <span style="color: var(--bs-white);"><strong>N40,000 - 70,000</strong></span>
                                                    </div>
                                                    <div class="card-body" style="padding-top: 0px;">
                                                        <h6 class="card-title">Harmony of the seas</h6>
                                                    </div>
                                                    <div class="align-items-center align-content-center card-footer">
                                                        <ul class="list-unstyled text-center d-md-inline-flex m-auto d-md-inline in" id="rating-1" display="inline-block" gap="20px">
                                                            <li style="font-size: 14px;color: #afafb0;"><i class="fa fa-star" style="color: var(--bs-yellow);"></i>&nbsp;4.7/5 Ratings&nbsp; &nbsp; &nbsp; &nbsp;</li>
                                                            <li class="justify-content-end" style="font-size: 14px;color: #afafb0;"><i class="icon ion-location" style="color: var(--bs-orange);"></i>&nbsp;Los Angeles, USA.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="carousel-item" style="background: #ffffff;">
                                    <div class="row g-0 slider-row">
                                        @for($i =0 ; $i < 4 ; $i++)
                                        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 offset-sm-0">
                                            <div class="card-group">
                                                <div class="card" style="margin: 10px;border-radius: 10px;margin-right: 10px;border-style: none;box-shadow: 1px 1px 10px 1px rgb(204,205,205);">
                                                    <img class="img-fluid card-img-top w-100 d-block" style="border-top-left-radius: 7px;border-top-right-radius: 7px;" src="{{asset('new-assets/img/tp3.png')}}">
                                                    <div class="card-img-overlay text-end" style="border-style: solid;color: rgba(33,37,41,0);">
                                                        <p style="color: var(--bs-white);font-size: 10px;margin-bottom: 1px;"><strong>Starting from</strong></p><span style="color: var(--bs-white);"><strong>N40,000 - 70,000</strong></span>
                                                    </div>
                                                    <div class="card-body" style="padding-top: 0px;">
                                                        <h6 class="card-title">Harmony of the seas</h6>
                                                    </div>
                                                    <div class="align-items-center align-content-center card-footer">
                                                        <ul class="list-unstyled text-center d-md-inline-flex m-auto d-md-inline in" id="rating-9" display="inline-block" gap="20px">
                                                            <li style="font-size: 14px;color: #afafb0;"><i class="fa fa-star" style="color: var(--bs-yellow);"></i>&nbsp;4.7/5 Ratings&nbsp; &nbsp; &nbsp; &nbsp;</li>
                                                            <li class="justify-content-end" style="font-size: 14px;color: #afafb0;"><i class="icon ion-location" style="color: var(--bs-orange);"></i>&nbsp;Los Angeles, USA.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>

                            </div>
                            <div class="d-none"><a class="carousel-control-prev" href="#carousel-top-margin" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-top-margin" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col" style="text-align: center;"><button class="btn btn-primary" type="submit" form="payment_plan" style="background: rgb(52,63,95);width: 253.969px;"><strong>CONTINUE TO PAYMENT</strong></button></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
