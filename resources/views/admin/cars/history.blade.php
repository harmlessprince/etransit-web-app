@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/manage/vehicle')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">{{$carHistory->car_type}} History</li>
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
                                  <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->daily_rentals}}</h4>
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
                                  <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->extra_hour}}</h4>
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
                                    <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->nc_fare}}</h4>
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
                                    <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->se_fare}}</h4>
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
                                    <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->ss_fare}}</h4>
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
                                    <h4 class="f-w-500 mb-0 f-26 counter">{{$carHistory->sw_fare}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-xl-12 box-col-12 col-md-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h5><span class="f-w-900 font-primary">{{$carHistory->car_type}}</span>  <span class="f-w-500 font-roboto">Transaction History</span></h5>
                                <br><br>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Flutterwave Reference</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Transaction Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Otto</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>Otto</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                        <td>Otto</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
