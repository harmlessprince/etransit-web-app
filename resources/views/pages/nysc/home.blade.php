@extends('layouts.app')

<style>
    .booking-details{
        border-top-style: none;
        border-right-style: none;
        border-left-style: none;
        border-radius: 0px;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 1px;
        background: rgba(255,255,255,0);
        padding-left: 14px;padding-right: 15px;
    }
    .tagline{
        color:rgba(7, 7, 140, 0.755);
    }
    @media ()
</style>
@section('content')
    <body style="border-style: none;border-bottom-width: 1px;border-color: rgb(236, 111, 28);">
    <section style="padding-left: 0px;border-color: rgb(236, 111, 28);">
        @if($errors->any())
        <div class="alert alert-danger">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">

        <div class="row align-self-center">
            <div class="left-image col-md-6">
                <img src="{{ asset('images\nysc\NYSC-Hero-image.jpg')}}" class="img-fluid" width="100%">
            </div>
            <div class="col-md-6 col-sm-12" style="padding: 5px;padding-top: 10px;padding-bottom: 10px;background: var(--bs-gray-100);">
                <h3 class="tagline">Enjoy seamsless travel to and from your camp</h3>
                <div class="row">
                    <div class="col">
                        <form action="{{url('/bus/bookings')}}" enctype="multipart/form-data" method="POST" id="become_driver">
                            @csrf
                            <input type="hidden" name="service_id" value="{{$busService->id}}" />
                            <input type="hidden" name="number_of_passengers" value="1"/>
                            <input type="hidden" name="trip_type" id="trip_type" class="one-way-trip-input" id="trip-form" value="1" />
                            <div class="row">
                              <div class="col-sm-6 col-md-12">
                                <select class="form-select form-select-md mb-3 " name="destination_from" aria-label=".form-select-lg example">
                                    <option selected>Select Camp</option>
                                    @foreach ($camps as $camp )
                                    <option value={{$camp->location_id}}>{{$camp->location->location}} </option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-sm-6 col-md-12">
                                <select class="form-select form-select-md mb-3" name="destination_to" aria-label=".form-select-lg example">
                                    <option selected>Destination</option>
                                    @foreach ($hubs as $hub )
                                    <option value={{$hub->location_id}}>{{$hub->location->location}} </option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="row">
                                <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);" >Departure Date</label>
                                <input class="form-control" id="datemob" type="date" name="departure_date"/>
                            </div>
                            <div class="row">
                                <div class="col" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">Call-Up Number</label>
                                    <input class="form-control form-control-sm align-self-center booking-details" type="text" name="callup" value="{{old('callup')}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">YOUR NAME</label>
                                    <input class="form-control form-control-sm align-self-center booking-details" type="text" name="name" @if(Auth::user()) value={{Auth()->user()->name}}  @endif  required></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">EMAIL ADDRESS</label>
                                    <input class="form-control form-control-sm align-self-center booking-details" type="text" name="email" @if(Auth::user()) value={{Auth()->user()->email}}  @endif required></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">PHONE NUMBER</label>
                                    <input class="form-control form-control-sm booking-details" type="text" name="phone" @if(Auth::user()) value={{Auth()->user()->phone_number}}  @endif  required></div>
                                </div>
                            </div>
                            <div class="col-12 d-md-flex justify-content-center align-items-center align-content-center align-self-center justify-content-md-center" style="text-align: center;margin-top: 14px;padding-bottom: 17px;">
                                <button class="btn btn-primary" type="submit" form="become_driver" style="width: 235.422px;background: rgb(52,63,95);">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>
@endsection
