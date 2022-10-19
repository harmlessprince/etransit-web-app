@extends('layouts.app')
<style>
    .anchor {
        text-decoration: none !important;
        color:#BDBDBD !important;
    }
    .card-title{
        color: #000 !important;
    }
    .search-container {
        max-width: 600px;
        z-index:1000;
        background: #eee !important;
    }
</style>
@section('content')
<section style="height: 226px;background: url('{{ asset('images/bg/boat_cruise.png')}}') center / cover no-repeat;">
    <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
        <div class="container d-md-flex justify-content-md-center align-items-md-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color: var(--bs-white);text-align: center;"><strong>Boat Cruise</strong></h1>
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
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Locations</strong></p>
                    </div>
                </div>
                <form action="{{url('boat-cruise')}}">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                @foreach($locations as $location)
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8">
                                                <input class="form-check-input" type="checkbox" name="locations[]" value="{{$location->id}}" id="formCheck-2">
                                            </div>
                                        </td>
                                        <td style="text-align: right;color: #000;">{{Ucfirst($location->destination)}}</td>
                                    </tr>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row" style="margin-bottom: 11px;">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Cruise Dates</strong></p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                        @foreach($boatCruise as $boat)
                            <tr>
                                <td>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8">
                                        <input class="form-check-input" type="checkbox" name="boat_dates[]" value="{{$boat->departure_date}}" id="formCheck-2">
                                    </div>
                                </td>
                                <td style="text-align: right;color: #000;">{{Ucfirst($boat->departure_date->format('Y-F-d'))}}</td>
                            </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col" x-data="{ show: false }">
                    <button class="btn btn-primary" type="submit" style="font-size: 10px;background: rgba(13,110,253,0);color: var(--bs-gray-900);border-color: #010000;border-right-color: var(--bs-gray-900);" >Filter</button>
                </div>
                </form>
            </div>



            <div class="col-sm-6 col-md-9" id="cruisedisplay">
                <div class="row" style="padding-left: 0px;padding-right: 0px;margin-top: 15px;margin-bottom: 15px;">
                    <h5 id="mddisplay">AVAILABLE CRUISE</h5>
                    <div class="col">
                        <div class="row text-start d-md-flex justify-content-start align-content-start justify-content-md-start" style="margin-right: 0px;margin-left: 0px;">
                            <div class="col-md-10 offset-md-1" style="padding-right: 0px;padding-left: 0px;">
                                <div class="card m-auto" style="max-width:850px">
                                    <div class="card-body text-start placeholder border rounded-0 d-md-flex align-items-start align-content-start search-container" style="height: 40px;padding-top: 5px;background: var(--bs-gray-100);border-radius: 7px;">
                                        <form class="d-flex align-items-center">
                                            <i class="fas fa-search d-none d-sm-block h4 text-body m-0" style="font-size: 15.704px;"></i>
                                            <input class="form-control form-control-lg flex-shrink-1 form-control-borderless search-container" type="search" id="search_boat" placeholder="Search Cruise" name="searchbar" style="height: 29px;padding-top: 0px;padding-bottom: 1px;min-height: 29px;font-size: 14px;background: var(--bs-gray-100);">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if(!is_null($boatCruise))
                    @foreach($boatCruise as $i => $boat)
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6" id="cruisedisplay-1" style="margin-left: 0px;">
                        <div class="card-group">
                            <a class="anchor" href="{{url('/boat-cruise/'.$boat->id.'/show')}}">
                            <div class="card" style="margin: 10px;border-radius: 10px;margin-right: 10px;border-style: none;box-shadow: 1px 1px 10px 1px rgb(204,205,205);">
                                @php
                                    $image = json_decode($boat->boat->paths);
                                @endphp
                                <img class="img-fluid card-img-top w-100 d-block" style="border-top-left-radius: 7px;border-top-right-radius: 7px;" src="{{ $image[0] ?? null}}" />
                                <div class="card-img-overlay text-end" style="border-style: solid;color: rgba(33,37,41,0);">
                                    <p style="color: var(--bs-white);font-size: 10px;margin-bottom: 1px;"><strong>Starting from</strong></p><span style="color: var(--bs-white);"><strong>&#x20A6; {{number_format($boat->min_amount)}} - &#x20A6; {{number_format($boat->max_amount)}}</strong></span>
                                </div>
                                <div class="card-body" style="padding-top: 0px;">
                                    <h6 class="card-title">{{$boat->cruise_name}}</h6>
                                    <h6>{!! \Illuminate\Support\Str::limit($boat->description, $limit = 150, $end = '...') !!} </h6>
                                </div>
                                <div class="align-items-center align-content-center card-footer">
                                    <ul class="list-unstyled text-center d-md-inline-flex m-auto d-md-inline in" id="rating-1" display="inline-block" gap="20px">
                                        <li class="justify-content-end" style="font-size: 14px;color: #afafb0;"><i class="icon ion-location" style="color: var(--bs-orange);"></i>{{$boat->cruiselocation->destination}}</li>
                                    </ul>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    @endForeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('boats-cruise/filter') }}";
    $('#search_boat').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });

</script>
@endsection
