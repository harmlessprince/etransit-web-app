@extends('layouts.app')
    <style>
        body {
            background-image: url("login-assets/img/Rectangle%203.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: metropolis-regular , Sans-Serif;
        }

        h1, h2,h3,h4,h5,h6{
            font-family: metropolis-semi-bold , Sans-Serif;
        }
    </style>
@section('content')
<body style="background: var(--bs-gray-300);border-style: none;border-bottom-width: 1px;border-bottom-color: rgb(168,168,169);">
<section style="padding-left: 0px;background: var(--bs-gray-100);">
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

        <div class="row">
            <div class="col-sm-3" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);"></div>
            <div class="col-sm-6" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: var(--bs-gray-100);">
                <div class="row">
                    <div class="col">
                        <form action="{{url('store/become-partners')}}" method="POST" id="become_partners">
                            @csrf
                            <div class="row">
                                <div class="col" style="margin-top: 44px;">
                                    <h6 style="text-align: center;">Fill Form To Get Started</h6>
                                      <div class="btn-group py-5 d-flex justify-content-center" style="text-align: center;">
                                        <a href="#" class="btn btn-outline-primary active" aria-current="page">I am a vehicle owner/operator</a>
                                        <a href="{{url('partners/driver')}}" class="btn btn-outline-primary ">I am a driver</a>
                                        </div>
                                    <p style="font-size: 14px;text-align: center;color: rgb(170,170,170);"> Earn reliable income on your vehicle or other assets via our commission based partnership scheme </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">FULL NAME</label>
                                    <input class="form-control form-control-sm" type="text" name="full_name" value="{{old('full_name')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);padding-left: 14px;padding-right: 15px;"></div>
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">COMPANY</label>
                                    <input class="form-control form-control-sm" name="company_name" type="text" value="{{old('company_name')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">EMAIL ADDRESS</label>
                                    <input class="form-control form-control-sm" type="email" name="email" value="{{old('email')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                                <div class="col d-block">
                                    <div class="row d-md-flex">
                                        <div class="col-md-12"><label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 22px;">PHONE NUMBER</label>
                                            <input class="form-control form-control-sm" type="text" name="phone_number" value="{{old('phone_number')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">COMPANY ADDRESS</label>
                                    <input class="form-control form-control-sm" type="text" name="company_address" value="{{old('company_address')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12 col-md-12">--}}
{{--                                    <label class="form-label" for="notes" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">Notes</label>--}}
{{--                                    <input class="form-control form-control-sm" type="text" name="notes" id="notes"--}}
{{--                                              style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col" style="margin-top: 44px;">
                                    <h6 style="text-align: center;">How would you like to partiner with us?&nbsp;</h6>
{{--                                    <p style="font-size: 13px;color: rgb(170,170,170);text-align: center;">Lorem ipsum is dummy text for use only</p>--}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bus_partner" id="formCheck-1">
                                        <label class="form-check-label" for="formCheck-1">Bus Transport Partner</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="car_hire" id="formCheck-2">
                                        <label class="form-check-label" for="formCheck-2">Car Hire Partner</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
{{--            <div class="col-sm-6" id="secondtab" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;margin-top: 0px;"></div>--}}
        </div>
        <div class="row">
            <div class="col-12 d-md-flex justify-content-center align-items-center align-content-center align-self-center justify-content-md-center" style="text-align: center;margin-top: 14px;padding-bottom: 17px;">
                <button class="btn btn-primary" type="submit" form="become_partners" style="width: 235.422px;background: rgb(52,63,95);">SUBMIT</button>
            </div>
        </div>
    </div>
</section>
@endsection

