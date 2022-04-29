@extends('layouts.app')
<style>
    .view_transactions {
        color: #f8a159;;
        text-decoration: none;
    }

    .view_transactions:hover {
        color:#f8a159;;
        text-decoration:none !important;
        cursor:pointer;
    }
</style>
@section('content')
    <section style="margin-top: 40px;margin-bottom: 40px;">
        <div class="container">
            <div class="row d-flex d-md-flex justify-content-md-center">
                <div class="col-sm-4 col-md-2 d-lg-flex justify-content-lg-center align-items-lg-center" id="profiletab" onclick="showProfile()" style="height: 60px;border-style: solid;border-color: var(--bs-gray-200);border-top-left-radius: 10px;border-bottom-left-radius: 10px;"><a href="#" id="profilelink" style="font-weight: bold;color: rgb(52,63,95);">Profile</a></div>
                <div class="col-sm-4 col-md-2 d-lg-flex justify-content-lg-center align-items-lg-center" id="statustab" onclick="showStatus()" style="height: 60px;border-style: solid;background: var(--bs-gray-200); border-color: var(--bs-gray-200);"><a href="#" id="statuslink" style="color: var(--bs-gray-600);">Trip Status</a></div>
                <div class="col-sm-4 col-md-2 d-lg-flex justify-content-lg-center align-items-lg-center" id="paymenttab" onclick="showPayment()" style="height: 60px;border-style: solid;background: var(--bs-gray-200); border-color: var(--bs-gray-200);border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><a href="#" id="paymentlink" style="color: var(--bs-gray-600);">Payment History</a></div>
            </div>
        </div>
    </section>
    <section style="margin-bottom: 20px;" id="profile">
        <div class="container">
            <div class="row d-lg-flex justify-content-lg-center">
                <div class="col-md-3" style="margin-bottom: 30px;">
                    <div class="text-center" style="padding-top: 30px;padding-bottom: 30px;box-shadow: 1px 1px 10px 1px rgb(232,232,232);border-radius: 10px;">
                        <div class="row">
                            <div class="col-12"><img style="border-radius: 50px;font-size: 8px;width: 80px;height: 80px;box-shadow: 1px 1px 7px rgb(184,185,186);border: 5px solid var(--bs-gray-100) ;" src="{{asset('new-assets/img/tp6.png')}}"><i class="fa fa-camera" id="uploadicon" style="color: rgb(44,57,94);"></i></div>
                            <div class="col-12">
                                <h6 style="margin-top: 14px;"><strong>{{auth()->user()->full_name}}</strong></h6>
                                <p>{{auth()->user()->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col d-lg-flex justify-content-lg-center" style="text-align: center;">
                            <button class="btn btn-primary" type="button" style="font-size: 12px;width: 115px;padding-right: 0px;padding-left: 0px;background: rgb(52,63,95);">SAVE CHANGES</button>
                        </div>
{{--                        <div class="col d-lg-flex justify-content-lg-center" style="text-align: center;"><button class="btn btn-primary" type="button" style="font-size: 12px;width: 115px;color: var(--bs-gray);background: rgba(13,110,253,0);border-color: var(--bs-gray-500);">CANCEL</button></div>--}}
                    </div>
                </div>

                <div class="col-md-6" style="padding-left: 20px;padding-right: 20px;">
                    <form
                        style="padding: 30px;border-radius: 10px;box-shadow: 1px 1px 13px 2px rgb(230,230,231);"
                        action="{{url('update-user-profile/'.auth()->user()->id)}}" method="post" id="updateProfile">
                        @csrf
                        @method('put')
                        <h5 style="color: rgb(52,63,95);">Account Details</h5>
                        <div class="row">
                            <div class="col-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label class="form-label" style="font-size: 14px;border-style: none;border-bottom-style: none;">FULL NAME</label>
                                <input class="form-control form-control-sm"
                                       type="text"
                                       name="full_name"
                                       value="{{auth()->user()->full_name}}"
                                       style="border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-top-style: none;border-top-color: var(--bs-gray-300);border-right-style: none;border-left-style: none;border-bottom-left-radius: 0px;">
                            </div>
                            <div class="col-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label class="form-label" style="font-size: 14px;border-style: none;border-bottom-style: none;">ADDRESS</label>
                                <input class="form-control form-control-sm"
                                       type="text"
                                       name="address"
                                       value="{{auth()->user()->address}}"
                                       style="border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-top-style: none;border-top-color: var(--bs-gray-300);border-right-style: none;border-left-style: none;border-bottom-left-radius: 0px;">
                            </div>
                            <div class="col-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label class="form-label" style="font-size: 14px;border-style: none;border-bottom-style: none;">PHONE NUMBER</label>
                                <input class="form-control form-control-sm"
                                       type="text" name="phone_number"
                                       value="{{auth()->user()->phone_number}}"
                                       style="border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-top-style: none;border-top-color: var(--bs-gray-300);border-right-style: none;border-left-style: none;border-bottom-left-radius: 0px;">
                            </div>
                            <div class="col-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label class="form-label" style="font-size: 14px;border-style: none;border-bottom-style: none;">EMAIL</label>
                                <input
                                    class="form-control form-control-sm"
                                    type="text"
                                    value="{{auth()->user()->email}}"
                                    style="border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-top-style: none;border-top-color: var(--bs-gray-300);border-right-style: none;border-left-style: none;border-bottom-left-radius: 0px;" readonly>
                            </div>
                            <div class="col-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label class="form-label" style="font-size: 14px;border-style: none;border-bottom-style: none;">PASSWORD</label>
                                <input class="form-control form-control-sm"
                                       type="password"
                                       name="password"
                                       style="border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-top-style: none;border-top-color: var(--bs-gray-300);border-right-style: none;border-left-style: none;border-bottom-left-radius: 0px;">
                            </div>
                            <div class="col-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <label class="form-label" style="font-size: 14px;border-style: none;border-bottom-style: none;">CONFIRM PASSWORD</label>
                                <input class="form-control form-control-sm"
                                       type="password"
                                       name="confirm_password"
                                       style="border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-top-style: none;border-top-color: var(--bs-gray-300);border-right-style: none;border-left-style: none;border-bottom-left-radius: 0px;"
                                >
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" style="font-size: 12px;width: 115px;padding-right: 0px;padding-left: 0px;background: rgb(52,63,95);">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Section was Trip Status-->
    <section style="margin-bottom: 20px;" id="Status">
        <div class="container">
            <div class="row d-lg-flex justify-content-lg-center">
                <div class="col-md-12" align="center" style="margin-bottom: 30px;">
                    <p>This is the section to insert your table </p>
                </div>

            </div>
        </div>
    </section>
    <!-- End of Trip Status section -->

    <section id="payment" style="display: none;">
        <div class="container">
            <div class="row">
                @foreach($services as $service)
                <div class="col-md-4" style="padding-top: 5px;padding-left: 40px;padding-right: 40px;padding-bottom: 5px;">
                    <div class="row" style="border-radius: 10px;box-shadow: 1px 0px 10px rgb(231,232,232);padding: 15px;">
                        <div class="col">
                            <div class="row" style="border-bottom: 4px none rgb(120,120,120) ;">
                                <div class="col" style="border-bottom: 1px solid rgb(208,208,208) ;">
                                    <p style="margin-bottom: 3px;"><strong>{{Ucfirst($service->name)}} Transaction</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="padding-left: 0px;border-bottom: 1px solid rgb(208,208,208) ;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 d-md-flex" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;">Total Bookings</p>
                                </div>
                                <div class="col-6 d-md-flex justify-content-md-end" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p class="text-end" style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;text-align: right;"><strong>N 69,400</strong></p>
                                </div>
                                <div class="col-6 d-md-flex" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;">View Transactions</p>
                                </div>
                                <div class="col-6 d-md-flex justify-content-md-end" style="padding-left: 0px;border-bottom: 1px dashed rgb(208,208,208) ;">
                                    <p class="text-end" style="color: #163a5e;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                                        <a href="{{url('view-user-transaction/'. auth()->user()->id . '/' . $service->id)}}" class="view_transactions">View</a>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="padding-left: 0px;border-bottom: 1px none rgb(208,208,208) ;">
                                    <div class="input-group mb-3"><span id="basic-addon1" class="input-group-text" style="margin-left: 0px;border-right-style: none;"><i class="fab fa-cc-mastercard" id="inputicon" style="margin-top: 1px;"></i></span><input class="placeholder form-control no-radius" type="text" id="removeradius" aria-label="Username" aria-describedby="basic-addon1" style="background: rgb(218,222,225);border: 2px solid rgb(206,212,218) ;border-right-style: solid;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script type="text/javascript">

        function showProfile(){
            document.getElementById('profile').style.display='block';
            document.getElementById('payment').style.display='none';
            document.getElementById('Status').style.display='none';
            document.getElementById('profiletab').style.backgroundColor="";
            document.getElementById('statustab').style.backgroundColor="var(--bs-gray-200)";
            document.getElementById('paymenttab').style.backgroundColor="var(--bs-gray-200)";
            document.getElementById('profilelink').style.fontWeight="bold";
            document.getElementById('profilelink').style.color="rgb(52,63,95)";
            document.getElementById('statuslink').style.fontWeight="";
            document.getElementById('statuslink').style.color="var(--bs-gray-600)";
            document.getElementById('paymentlink').style.fontWeight="";
            document.getElementById('paymentlink').style.color="var(--bs-gray-600)";
        }

        function showStatus(){
            document.getElementById('profile').style.display='none';
            document.getElementById('payment').style.display='none';
            document.getElementById('Status').style.display='block';
            document.getElementById('profiletab').style.backgroundColor="var(--bs-gray-200)";
            document.getElementById('statustab').style.backgroundColor="";
            document.getElementById('paymenttab').style.backgroundColor="var(--bs-gray-200)";
            document.getElementById('statuslink').style.fontWeight="bold";
            document.getElementById('statuslink').style.color="rgb(52,63,95)";
            document.getElementById('profilelink').style.fontWeight="";
            document.getElementById('profilelink').style.color="var(--bs-gray-600)";
            document.getElementById('paymentlink').style.fontWeight="";
            document.getElementById('paymentlink').style.color="var(--bs-gray-600)";
        }

        function showPayment(){
            document.getElementById('profile').style.display='none';
            document.getElementById('payment').style.display='block';
            document.getElementById('Status').style.display='none';
            document.getElementById('profiletab').style.backgroundColor="var(--bs-gray-200)";
            document.getElementById('statustab').style.backgroundColor="var(--bs-gray-200)";
            document.getElementById('paymenttab').style.backgroundColor="";
            document.getElementById('statuslink').style.fontWeight="";
            document.getElementById('statuslink').style.color="var(--bs-gray-600)";
            document.getElementById('profilelink').style.fontWeight="";
            document.getElementById('profilelink').style.color="var(--bs-gray-600)";
            document.getElementById('paymentlink').style.fontWeight="bold";
            document.getElementById('paymentlink').style.color="rgb(52,63,95)";
        }



    </script>
@endsection
