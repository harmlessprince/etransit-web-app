@extends('layouts.app')
<style>
    .anchor {
        text-decoration: none !important;
        color:#BDBDBD !important;
    }
    .card-title{
        color: #000 !important;
    }
</style>
@section('content')
{{--    <div>--}}
{{--        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/tour.png')}}'); height:200px;" >--}}
{{--            <div class="booking_hero_text">--}}
{{--                <div class="booking_hero_icon">--}}
{{--                    <a href="{{url('/')}}">--}}
{{--                    <img src="{{asset('/images/icons/arrow_left_2.png')}}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="booking_text">--}}
{{--                    <h1>{{$service->name}}</h1>--}}
{{--                    <span>Lorem ipsum text here  Lorem ipsum text here Lorem ipsum text here</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="boat_cruise_box">--}}
{{--            <div class="navigation">--}}
{{--                <div class="nav_header">--}}
{{--                    <h5>Filter Search</h5>--}}
{{--                    <span>Clear</span>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--            </div>--}}
{{--            <div class="boat_list">--}}
{{--                <div>--}}
{{--                    <h3>Available Tours</h3>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <input type="text" placeholder="search"  class="search_text"/>--}}
{{--                </div>--}}
{{--                <div class="boat_cruise_list">--}}
{{--                    @foreach($tours as $index => $tour)--}}
{{--                        <a href="{{url('/tour-packages/'.$tour->id.'/show')}}">--}}
{{--                        <div class="boat_card">--}}
{{--                            <div class="backgrund_img" >--}}
{{--                                <img src="{{$tour->tourimages[0]->path}}" />--}}
{{--                                <div class="price_tag">--}}
{{--                                    <h5>{{$tour->name}}</h5>--}}
{{--                                    <h5> &#x20A6; {{number_format($tour->amount_regular)}}  -  &#x20A6; {{number_format($tour->amount_standard)}}</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="ratings_box" >--}}
{{--                                <h5>Harmony of seas</h5>--}}
{{--                                <small>--}}
{{--                                    {{ \Illuminate\Support\Str::limit($tour->description, $limit = 150, $end = '...') }}--}}
{{--                                </small>--}}
{{--                                <div class="ratings_location">--}}
{{--                                    <div>--}}
{{--                                        <img src="{{asset('/images/icons/ratings.png')}}" alt="ratings-img"/>--}}
{{--                                        <small>4.7/5 Ratings</small>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <img src="{{asset('/images/icons/location.png')}}" alt="location-img"/>--}}
{{--                                        <small>{{$tour->location}}</small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<section style="height: 226px;background: url('{{ asset('new-assets/img/tp.png')}}')  center / cover no-repeat;">
    <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
        <div class="container d-md-flex justify-content-md-center align-items-md-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color: var(--bs-white);text-align: center;"><strong>Tour Packages</strong></h1>
                    <p style="font-size: 20px;color: var(--bs-white);text-align: center;">Loren ipsum dolor</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="margin: 20px;border-style: none;margin-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 flex-grow-0 flex-shrink-1 flex-wrap" style="box-shadow: 1px 1px 6px 1px rgb(189,189,190);padding-top: 15px;padding-bottom: 15px;border-radius: 9px;min-height: 500px;max-height: 600px;">
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
            <div class="col-sm-6 col-md-9" id="cruisedisplay">
                <div class="row" style="padding-left: 0px;padding-right: 0px;margin-top: 15px;margin-bottom: 15px;">
                    <h5 id="mddisplay">Available Package&nbsp;</h5>
                    <div class="col">
                        <div class="row text-start d-md-flex justify-content-start align-content-start justify-content-md-start" style="margin-right: 0px;margin-left: 0px;">
                            <div class="col-md-10 offset-md-1" style="padding-right: 0px;padding-left: 0px;">
                                <div class="card m-auto" style="max-width:850px">
                                    <div class="card-body text-start placeholder border rounded-0 d-md-flex align-items-start align-content-start" style="height: 40px;padding-top: 5px;background: var(--bs-gray-100);border-radius: 7px;">
                                        <form class="d-flex align-items-center"><i class="fas fa-search d-none d-sm-block h4 text-body m-0" style="font-size: 15.704px;"></i><input class="form-control form-control-lg flex-shrink-1 form-control-borderless" type="search" placeholder="Search Cruise" name="searchbar" style="height: 29px;padding-top: 0px;padding-bottom: 1px;min-height: 29px;font-size: 14px;background: var(--bs-gray-100);"></form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($tours as $index => $tour)
                        <a class="anchor" href="{{url('/tour-packages/'.$tour->id.'/show')}}">
                           <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6" id="cruisedisplay-1" style="margin-left: 0px;">
                        <div class="card-group">
                            <div class="card" style="margin: 10px;border-radius: 10px;margin-right: 10px;border-style: none;box-shadow: 1px 1px 10px 1px rgb(204,205,205);">
                                <img class="img-fluid card-img-top w-100 d-block" style="border-top-left-radius: 7px;border-top-right-radius: 7px;" src="{{$tour->tourimages[0]->path}}">
                                <div class="card-img-overlay text-end" style="border-style: solid;color: rgba(33,37,41,0);">
                                    <p style="color: var(--bs-white);font-size: 10px;margin-bottom: 1px;"><strong>Starting from</strong></p><span style="color: var(--bs-white);"><strong> &#x20A6; {{number_format($tour->amount_regular)}}  -  &#x20A6; {{number_format($tour->amount_standard)}}</strong></span>
                                </div>
                                <div class="card-body" style="padding-top: 0px;">
                                    <h6 class="card-title" style="margin-top: 10px;">{{$tour->name}}</h6>
                                    <p style="color: rgb(175,175,176);font-size: 14px;"> {{ \Illuminate\Support\Str::limit($tour->description, $limit = 150, $end = '...') }}</p>
                                </div>
                                <div class="align-items-center align-content-center card-footer">
                                    <ul class="list-unstyled text-center d-md-inline-flex m-auto d-md-inline in" id="rating-1" display="inline-block" gap="20px">
                                        <li style="font-size: 14px;color: #afafb0;"><i class="fa fa-star" style="color: var(--bs-yellow);"></i>&nbsp;4.7/5 Ratings&nbsp; &nbsp; &nbsp; &nbsp;</li>
                                        <li class="justify-content-end" style="font-size: 14px;color: #afafb0;"><i class="icon ion-location" style="color: var(--bs-orange);"></i>&nbsp;{{$tour->location}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
