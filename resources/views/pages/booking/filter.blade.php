@extends('layouts.app')
<style>
    .no_data_img {
        display: flex;
        justify-content: center;
    }
</style>

@section('content')
    <section
        style="height: 226px;background: url('../new-assets/img/Rectangle%2015%20(2).png') center / cover no-repeat;">
        <div
            class="d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center"
            style="height: 226px;background: rgba(11,8,8,0.73);">
            <div class="container d-md-flex justify-content-md-center align-items-md-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="color: var(--bs-white);text-align: center;"><strong>Co-Traveller&nbsp;</strong></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin: 20px;border-style: none;margin-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 flex-grow-0 flex-shrink-1 flex-wrap"
                     style="box-shadow: 1px 1px 6px 1px rgb(228,228,230);padding-top: 15px;padding-bottom: 15px;border-radius: 9px;min-height: 500px;max-height: 900px;margin-bottom: 10px;height: 850px;background: #ffffff;">
                    <div class="row">
                        <div class="col">
                            <p style="margin-bottom: 0PX;font-size: 14px;"><strong>FILTER SEARCH</strong></p>
                        </div>
                        <div class="col-md-auto"><a class="text-decoration-none" href="#" style="color: #ed954d;">Clear
                                all</a></div>
                    </div>
                    <hr>
                    <form action="{{url('/bus/filter-bookings')}}" method="POST">
                        @csrf
                        <div class="row" style="margin-bottom: 11px;">
                            <div class="col">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;">
                                    <strong>Operators</strong></p>
                            </div>
                            <div class="col" style="text-align: right;">
                                <div class="" style="height: 24px;">
                                    <button class="btn btn-primary" aria-expanded="false" data-bs-toggle=""
                                            type="button"
                                            style="color: #ed954d;background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">
                                        Reset
                                    </button>
                                    <!-- <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">First Item</a>
                                        <a class="dropdown-item" href="#">Second Item</a>
                                        <a class="dropdown-item" href="#">Third Item</a></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                        @foreach($operators as $operator)
                                            <div>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="bus_operator_input form-check-input"
                                                                   name="bus_operator[]"
                                                                   value="{{$operator->id}}"
                                                                   type="checkbox"
                                                                   id="formCheck-8">
                                                            <label class="form-check-label"
                                                                   for="formCheck-8">{{$operator->display_name}}</label>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: right;color: #afafb0;">
                                                        <img src="{{$operator->image_url}}" height="20" width="20"/>
                                                    </td>
                                                </tr>
                                            </div>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <p style="margin-top: 4px;margin-bottom: 0px;font-size: 13px;"><strong>Bus Type</strong>
                                </p>
                            </div>
                            <div class="col" style="text-align: right;">
                                <div class="" style="height: 24px;">
                                    <button class="btn btn-primary" aria-expanded="false" data-bs-toggle=""
                                            type="button"
                                            style="color: #ef954d;background: var(--bs-white);border-color: rgba(249,249,249,0);height: 24px;padding-top: 1px;">
                                        Reset
                                    </button>
                                    <!-- <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">First Item</a>
                                        <a class="dropdown-item" href="#">Second Item</a>
                                        <a class="dropdown-item" href="#">Third Item</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                @foreach($busTypes as $type)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="bus_type[]"
                                                       value="{{$type->type}}" id="formCheck-2">
                                                <label class="form-check-label" for="formCheck-2"
                                                       style="color: #afafb0;">{{$type->type}}</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if(!is_null($checkSchedule))
                                    <input type="hidden" name="departure_date" value="{{$departureDate}}"/>
                                    <input type="hidden" name="trip_type" value="1"/>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col" x-data="{ show: false }">
                            <button class="btn btn-primary" type="submit"
                                    style="font-size: 10px;background: rgba(13,110,253,0);color: var(--bs-gray-900);border-color: #010000;border-right-color: var(--bs-gray-900);"
                                    @click="showSomet()">Filter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-9" id="cruisedisplay" style="padding-left: 0px;padding-right: 0px;">
                    <div class="row" id="optionline-1"
                         style="padding-left: 0px;padding-right: 0px;margin-top: 0px;margin-bottom: 15px;margin-left: 10px;margin-right: 0px;background: var(--bs-gray-200);">
                        <div class="col" style="background: var(--bs-gray-200);border-right: 1px none #bebebe;">
                            <div class="" id="targetcenter-1"
                                 style="border-style: none;background: rgba(238,238,238,0);">
                                <button class="btn btn-primary " aria-expanded="false" data-bs-toggle="" type="button"
                                        style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">
                                    &nbsp;From
                                </button>
                                <!--  <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div> -->
                            </div>
                            <p style="font-weight: bold;text-align: center;">Lagos<span
                                    style="color: rgb(146,144,144);margin-left: 5px;">Ikeja</span></p>
                        </div>
                        <div class="col d-lg-flex justify-content-lg-center align-items-lg-center"
                             style="background: var(--bs-gray-200);">
                            <p style="color: rgb(121,122,122);text-align: center;">
                                <svg xmlns="https://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                     fill="none" style="font-size: 33px;">
                                    <path
                                        d="M4.99255 12.9841C4.44027 12.9841 3.99255 13.4318 3.99255 13.9841C3.99255 14.3415 4.18004 14.6551 4.46202 14.8319L7.14964 17.5195C7.54016 17.9101 8.17333 17.9101 8.56385 17.5195C8.95438 17.129 8.95438 16.4958 8.56385 16.1053L7.44263 14.9841H14.9926C15.5448 14.9841 15.9926 14.5364 15.9926 13.9841C15.9926 13.4318 15.5448 12.9841 14.9926 12.9841L5.042 12.9841C5.03288 12.984 5.02376 12.984 5.01464 12.9841H4.99255Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M19.0074 11.0159C19.5597 11.0159 20.0074 10.5682 20.0074 10.0159C20.0074 9.6585 19.82 9.3449 19.538 9.16807L16.8504 6.48045C16.4598 6.08993 15.8267 6.08993 15.4361 6.48045C15.0456 6.87098 15.0456 7.50414 15.4361 7.89467L16.5574 9.01589L9.00745 9.01589C8.45516 9.01589 8.00745 9.46361 8.00745 10.0159C8.00745 10.5682 8.45516 11.0159 9.00745 11.0159L18.958 11.0159C18.9671 11.016 18.9762 11.016 18.9854 11.0159H19.0074Z"
                                        fill="currentColor"></path>
                                </svg>
                            </p>
                        </div>
                        <div class="col" style="background: var(--bs-gray-200);border-right: 1px solid #bebebe;">
                            <div class="" style="border-style: none;background: rgba(238,238,238,0);">
                                <button class="btn btn-primary" aria-expanded="false" data-bs-toggle="" type="button"
                                        style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">
                                    To&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                </button>
                                <!-- <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div> -->
                            </div>
                            <p style="font-weight: bold;text-align: center;">Abia<span
                                    style="color: rgb(146,144,144);margin-left: 5px;">Aba</span></p>
                        </div>
                        <div class="col" style="background: var(--bs-gray-200);">
                            <div class="" style="border-style: none;background: rgba(238,238,238,0);">
                                <button class="btn btn-primary" aria-expanded="false" data-bs-toggle="" type="button"
                                        style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">
                                    Departure&nbsp;&nbsp;
                                </button>
                                <!-- <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div> -->
                            </div>
                            <p style="font-weight: bold;text-align: left;margin-bottom: 0px;">&nbsp; &nbsp;October</p>
                            <p style="color: rgb(121,122,122);">&nbsp; &nbsp;Tuesday</p>
                        </div>
                        <div class="col" style="background: var(--bs-gray-200);">
                            <div class="" id="targetcenter-3"
                                 style="border-style: none;background: rgba(238,238,238,0);text-align: center;">
                                <button class="btn btn-primary" aria-expanded="false" data-bs-toggle="" type="button"
                                        style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">
                                    Return&nbsp;&nbsp;
                                </button>
                                <!-- <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div> -->
                            </div>
                            <p style="font-weight: bold;text-align: center;margin-bottom: 0px;">1</p>
                        </div>
                        <div class="col mx-auto" style="background: var(--bs-gray-200);">
                            <div class="" style="border-style: none;background: rgba(238,238,238,0);">
                                <button class="btn btn-primary" aria-expanded="false" data-bs-toggle="" type="button"
                                        style="color: rgb(136,136,136);background: rgba(238,238,238,0);border-style: none;">
                                    Passenger and class
                                </button>
                                <!-- <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div> -->
                            </div>
                            <p style="font-weight: bold;text-align: left;margin-bottom: 0px; text-align: center;">&nbsp;
                                &nbsp;1 Adult</p>
                            <p style="color: rgb(121,122,122); text-align: center;">&nbsp; &nbsp;Business class</p>
                        </div>
                    </div>

                    @if(count($checkSchedule) > 0)
                        @foreach($checkSchedule as $schedule)
                            <div class="row" style="padding: 3px;">
                                <div class="col" id="autopadding"
                                     style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                                    <div class="row"
                                         style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                        <div class="col d-lg-flex justify-content-lg-center align-items-lg-center">
                                            <img src="{{asset('new-assets/img/pngaaa%201.png')}}"></div>
                                        <div class="col align-self-center">
                                            <h5 class="text-start">{{$schedule->terminal->terminal_name}}</h5>
                                            <p class="text-start" style="font-size: 17px;">
                                                <span>{{$schedule->pickup->location}} </span><span>&nbsp;&nbsp;<svg
                                                        xmlns="https://www.w3.org/2000/svg" width="1em" height="1em"
                                                        fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-arrow-right">
                                                <path fill-rule="evenodd"
                                                      d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                            </svg>&nbsp;&nbsp;</span><span>{{$schedule->destination->location}} </span>
                                            </p>
                                            <label class="form-label"
                                                   style="background: var(--bs-orange);border-radius: 6px;">&nbsp;&nbsp;<i
                                                    class="fa fa-star"></i> A\C&nbsp; &nbsp;</label>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-start">Departure Data</h5>
                                            <p class="text-start" style="font-size: 17px;"><span>&nbsp;<svg
                                                        xmlns="https://www.w3.org/2000/svg" width="1em" height="1em"
                                                        fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-clock-fill">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"></path>
                                            </svg>&nbsp;&nbsp;</span><span>{{$schedule->departure_time}}</span></p>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-start">Available Seat</h5>
                                            <p class="text-start" style="font-size: 17px;"><span>&nbsp;<i
                                                        class="material-icons"
                                                        style="font-size: 33px;color: var(--bs-orange);">airline_seat_recline_extra</i>&nbsp;&nbsp;</span>
                                                <span>{{$schedule->seats_available}}</span></p>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-start">Operator</h5>
                                            <p class="text-start"
                                               style="font-size: 17px;">@if(!is_null($schedule->tenant->image_url))
                                                    <span>&nbsp; <img src="{{$schedule->tenant->image_url}}"
                                                                      alt="company-logo" width="25px" height="25px"/>&nbsp;&nbsp;</span>
                                                @endif
                                                <span>{{$schedule->tenant->display_name}}</span></p>
                                        </div>
                                        <div class="col text-center">
                                            <p class="text-center">Adult&nbsp;&nbsp;<span style="color: rgb(52,63,95);"><strong>&#x20A6; {{number_format($schedule->fare_adult)}}</strong></span>&nbsp;
                                            </p>
                                            <a href="{{url('seat-picker/'.$schedule->id. '/'.$tripTypeId)}}">
                                                <button class="btn btn-primary" type="button"
                                                        style="color: rgb(255,255,255);background: rgb(52,63,95);height: 29px;padding-top: 1px;width: 125.766px;">
                                                    VIEW SEAT
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row" style="padding: 3px;">
                            <div class="col" id="autopadding"
                                 style="padding: 20px;padding-top: 36px;padding-left: 38px;">
                                <div class="row"
                                     style="border-radius: 7px;box-shadow: 2px 1px 5px 1px rgb(226,226,227);padding: 17px;background: #ffffff;">
                                    <div class="no_data_img">
                                        <div>
                                            <img src="{{asset('images/illustrations/empty_data.png')}}" width="400"
                                                 height="300" alt="bus-image"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
