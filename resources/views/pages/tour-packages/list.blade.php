@extends('layouts.app')
<style>
    .anchor {
        text-decoration: none !important;
        color:#BDBDBD !important;
    }
    .card-title{
        color: #000 !important;
    }
    .display_row{
        display:grid;
        grid-row: auto;
    }
    .search-container {
        max-width: 600px;
        z-index:1000;
        background: #eee !important;


    }

</style>
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />--}}

@section('content')
<section style="height: 226px;background: url('{{ asset('new-assets/img/tp.png')}}')  center/cover no-repeat;">
    <div class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center" style="height: 226px;background: rgba(11,8,8,0.73);">
        <div class="container d-md-flex justify-content-md-center align-items-md-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="color: var(--bs-white);text-align: center;"><strong>Tour Packages</strong></h1>
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
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;cursor: pointer;" onclick="collapse('tour-types')"><strong>Tour Type</strong></p>
                    </div>
                </div>
                <hr>
                <form method="GET" action="{{url('tour-packages')}}">
                    @csrf
                <div class="table-responsive d-none d-md-block" id="tour-types">
                    <table class="table table-borderless">
                        <tbody>
                        @foreach($tour_types as $type)
                            <tr>
                                <td>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8">
                                        <input class="form-check-input" type="checkbox" name="tour_types[]" value="{{$type}}" id="formCheck-2">
                                    </div>
                                </td>
                                <td style="text-align: right;color: #000;">{{Ucfirst($type)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row" style="margin-bottom: 11px;">
                    <div class="col">
                        <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;cursor: pointer;" onclick="collapse('tour-dates')"><strong>Tour Dates</strong></p>
                    </div>
                </div>
                <hr>
                <div class="table-responsive d-none d-md-block" id="tour-dates">
                    <table class="table table-borderless">
                        <tbody>
                        @foreach($tours as $tour)
                            <tr>
                                <td>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8">
                                        <input class="form-check-input" type="checkbox" name="tour_dates[]" value="{{$tour->tour_date}}" id="formCheck-2">
                                    </div>
                                </td>
                                <td style="text-align: right;color: #000;">{{Ucfirst($tour->tour_date->format('Y-F-d'))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                    <div class="col" x-data="{ show: false }">
                        <button class="btn btn-primary" type="submit" style="font-size: 10px;background: rgba(13,110,253,0);color: var(--bs-gray-900);border-color: #010000;border-right-color: var(--bs-gray-900);" @click="showSomet()">Filter</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 col-md-9" id="cruisedisplay">
                <div class="row" style="padding-left: 0px;padding-right: 0px;margin-top: 15px;margin-bottom: 15px;">
                    <h5 id="mddisplay">Available Package&nbsp;</h5>
                    <div class="col">
                        <div class="row text-start d-md-flex justify-content-start align-content-start justify-content-md-start" style="margin-right: 0px;margin-left: 0px;">
                            <div class="col-md-10 offset-md-1" style="padding-right: 0px;padding-left: 0px;">
                                <div class="card m-auto" style="max-width:850px">
                                    <div class="card-body text-start placeholder border rounded-0 d-md-flex align-items-start align-content-start search-container" style="height: 40px;padding-top: 5px;background: var(--bs-gray-100);border-radius: 7px;">
                                        <form class="d-flex align-items-center">
                                            <i class="fas fa-search d-none d-sm-block h4 text-body m-0" style="font-size: 15.704px;"></i>
                                            <input class="form-control form-control-lg flex-shrink-1 form-control-borderless search-container" id="search" type="search" placeholder="Search Tour" name="searchbar" style="height: 29px;padding-top: 0px;padding-bottom: 1px;min-height: 29px;font-size: 14px;background: var(--bs-gray-100);">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-md-12 col-lg-12 col-sm-12 col-xs-12" >
                    @foreach($tours as $index => $tour)
                        <a class="anchor" href="{{url('/tour-packages/'.$tour->id.'/show')}}">
                           <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6" id="cruisedisplay-1" style="margin-left: 0px;">
                               <div class="card-group">
                                <div class="card" style="margin: 10px;border-radius: 10px;margin-right: 10px;border-style: none;box-shadow: 1px 1px 10px 1px rgb(204,205,205);">
                                    <img class="img-fluid card-img-top w-100 d-block" style="border-top-left-radius: 7px;border-top-right-radius: 7px;" src="{{$tour->tourimages[0]->path}}">
                                    <div class="card-img-overlay text-end" style="border-style: solid;color: rgba(33,37,41,0);">
                                        <p style="color: var(--bs-white);font-size: 10px;margin-bottom: 1px;">
                                            <strong>Starting from</strong>
                                        </p>
                                        <span style="color: var(--bs-white);"><strong> &#x20A6; {{number_format($tour->amount_regular)}}  -  &#x20A6; {{number_format($tour->amount_standard)}}</strong>
                                        </span>
                                    </div>
                                    <div class="card-body" style="padding-top: 0px;">
                                        <h6 class="card-title" style="margin-top: 10px;">{{$tour->name}}</h6>
                                        <p style="color: rgb(175,175,176);font-size: 14px;"> {!! \Illuminate\Support\Str::limit($tour->description, $limit = 150, $end = '...') !!}  </p>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ url('tour-packages/filter') }}";
    $('#search').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script>
    <script>
        function collapse(id){

            const attr = $('#'+id).hasClass('d-none');

            if (attr === false) {
                $('#'+id).addClass('d-none');
            }else{
                $('#'+id).removeClass('d-none');
            }
        }
    </script>
@endsection
