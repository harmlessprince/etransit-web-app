@extends('admin.layout.app')
<style>
    .trip-status_off{
        background: red;
        color:white;
        padding:5px;
        border-radius: 4px;
    }
    .trip-status_on{
        background: green;
        color:white;
        padding:5px;
        border-radius: 4px;
    }
</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
{{--                        <li class="breadcrumb-item">{{$carHistory->car_type}} History</li>--}}
                    </ol>
                </div>
                <div class="col-6">
                    <!-- Bookmark Start-->
                    <div class="bookmark pull-right">
                        <ul>
                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                            <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                                <form class="form-inline search-form" action="#" method="get">
                                    <div class="form-group form-control-search">
                                        <div class="Typeahead Typeahead--twitterUsers">
                                            <div class="u-posRelative">
                                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search.." name="q" title="" autofocus>
                                                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                                            </div>
                                            <div class="Typeahead-menu"></div>
                                            <script id="result-template" type="text/x-handlebars-template">
                                                <div class="ProfileCard u-cf">
                                                    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                                                    <div class="ProfileCard-details">
                                                        <div class="ProfileCard-realName">some name</div>
                                                    </div>
                                                </div>
                                            </script>
                                            <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- Bookmark Ends-->
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Total Trips</span><span class="f-w-700 font-primary ml-2">35.00%</span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">9,050</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Revenue Generated</span></p>
                                <h4 class="f-w-500 mb-0 f-26 counter">9,050</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Trips Per Day</span><span class="f-w-700 font-primary ml-2">(12 Hours)</span></p>
{{--                                <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->daily_rentals}}</h4>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">Extra Hour</span><span class="f-w-700 font-primary ml-2"></span></p>
{{--                                <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->extra_hour}}</h4>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">North Central Trip Fare</span><span class="f-w-700 font-primary ml-2"></span></p>
{{--                                <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->nc_fare}}</h4>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">South East Trip Fare</span><span class="f-w-700 font-primary ml-2"></span></p>
{{--                                <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->se_fare}}</h4>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">South south Trip Fare</span><span class="f-w-700 font-primary ml-2"></span></p>
{{--                                <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->ss_fare}}</h4>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 box-col-3 col-md-3">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <p><span class="f-w-500 font-roboto">South west Trip Fare</span><span class="f-w-700 font-primary ml-2">%</span></p>
{{--                                <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->sw_fare}}</h4>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">
                    <a href="{{url('/admin/edit/'.$boatHistory->id . '/boat')}}">
                        <button class="btn btn-success">Edit {{$boatHistory->name}}</button>
                    </a>
                <br><br>
{{--                <div class="card o-hidden">--}}
{{--                    <div class="card-header card-no-border">--}}
{{--                        <div class="media">--}}
{{--                            <div class="media-body">--}}
{{--                                <h5><span class="f-w-900 font-primary">{{$carHistory->car_name}}</span>  <span class="f-w-500 font-roboto">History</span></h5>--}}
{{--                                <br><br>--}}
{{--                                <table class="table table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th scope="col">#</th>--}}
{{--                                        <th scope="col">Payment Type</th>--}}
{{--                                        <th scope="col">Trip Status</th>--}}
{{--                                        <th scope="col">Booked</th>--}}
{{--                                        <th scope="col">Hired By</th>--}}
{{--                                        <th scope="col">Plan Amount</th>--}}
{{--                                        <th scope="col">Plan</th>--}}
{{--                                        <th scope="col">Extra Hour (Amount)</th>--}}
{{--                                        <th scope="col">Extra Hour (Minutes)</th>--}}
{{--                                        <th scope="col">Pick up Date</th>--}}
{{--                                        <th scope="col">Pick up time</th>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($histories as $index => $history)--}}
{{--                                        <tr>--}}
{{--                                            <th scope="row">{{$index+1}}</th>--}}
{{--                                            <td>--}}
{{--                                                {{$history->payment_status}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($history->available_status ==  'Off Trip')--}}
{{--                                                    <span class="trip-status_off">--}}
{{--                                                {{$history->available_status}}--}}
{{--                                               </span>--}}
{{--                                                @else--}}
{{--                                                    <span class="trip-status_on">--}}
{{--                                                {{$history->available_status}}--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($history->isConfirmed ==  'True')--}}
{{--                                                    <span class="trip-status_on">--}}
{{--                                                 {{$history->isConfirmed}}--}}
{{--                                               </span>--}}
{{--                                                @else--}}
{{--                                                    <span class="trip-status_off">--}}
{{--                                                 {{$history->isConfirmed}}--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>{{$history->user->email}}</td>--}}
{{--                                            <td>{{number_format($history->carplan->amount)}}</td>--}}
{{--                                            <td>{{$history->carplan->plan}}</td>--}}
{{--                                            <td>{{number_format($history->amount_to_remit_after_delayed_trip)}}</td>--}}
{{--                                            <td>{{$history->delayed_trip_in_minutes ?? 'Nil'}}</td>--}}
{{--                                            <td>{{$history->date->format('d M Y')}}</td>--}}
{{--                                            <td>{{$history->time}}</td>--}}

{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
