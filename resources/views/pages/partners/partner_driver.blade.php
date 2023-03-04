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
                        <div class="row">
                            <div class="col" style="margin-top: 44px;">
                                <h6 style="text-align: center;">Fill Form To Get Started</h6>
                                <div class="btn-group py-5 d-flex justify-content-center" style="text-align: center;">
                                    <a href="#" class="btn btn-outline-primary active partner-button" aria-current="page">I am a vehicle owner/operator</a>
                                    <a href="#" class="btn btn-outline-primary driver-button">I am a driver</a>
                                </div>
                            </div>
                        </div>
                        <div class="partner_div">
                          <p style="font-size: 14px;text-align: center;color: rgb(170,170,170);"> Earn reliable income on your vehicle or other assets via our commission based partnership scheme </p>
                         <form action="{{url('store/become-partners')}}" method="POST" id="become_partner">
                            @csrf
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
                        <div class="driver_div" style="display: none">
                            <p style="font-size: 14px;text-align: center;"> Enjoy full predictable income when you join Etransit as a driver</p>
                            <br/>
                            <span class="fs-6"><i class="fas fa-money-bill" style="color: rgb(52, 63, 95)"></i> your own per diem rate and get a full day's pay on each booking</span>
                            <br/>
                            <span class="fs-6"><i class="fas fa-map-marked" style="color: rgb(52, 63, 95)"></i> Lucrative out of state bookings available</span>
                            <br/>
                            <span class="fs-6"><i class="fas fa-car" style="color: rgb(52, 63, 95)"></i> No Vehicle.No Problem. Use one from our fleet or provided by your client</span>

                            <form action="{{url('partners/driver/register')}}" enctype="multipart/form-data" method="POST" id="become_driver">
                            @csrf

                            <input type="hidden" name="self_managed" value="true">
                            <div class="row">
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">FULL NAME</label>
                                    <input class="form-control form-control-sm" type="text" name="full_name" value="{{old('full_name')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);padding-left: 14px;padding-right: 15px;" required></div>
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">DATE OF BIRTH</label>
                                    <input class="form-control form-control-sm" name="dob" type="date" value="{{old('dob')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background:" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" style="margin-top: 28px;">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);">USERNAME</label>
                                    <input class="form-control form-control-sm" type="text" name="username" value="{{old('username')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);padding-left: 14px;padding-right: 15px;" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;"> Years of experience</label>
                                    <input type="range" class="form-range" min="1" max="52" id="experience" onchange="updateexp()" name="experience" style=" color: rgba(255, 94, 0, 0.952);" required>
                                    <span class="align-middle fs-4" id="expvalue" style="color: rgba(255, 94, 0, 0.952)"></span>
                                </div>

                                <div id="experienceHelpBlock" class="form-text">
                                    Drag the slider to indicate years of experience
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">EMAIL ADDRESS</label>
                                    <input class="form-control form-control-sm" type="email" name="email" value="{{old('email')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" required>
                                </div>
                                <div class="col d-block">
                                    <div class="row d-md-flex">
                                        <div class="col-md-12"><label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 22px;">PHONE NUMBER</label>
                                            <input class="form-control form-control-sm" type="text" name="phone" value="{{old('phone')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">HOME ADDRESS</label>
                                    <input class="form-control form-control-sm" type="text" name="home_address" value="{{old('home_address')}}" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" required>
                                </div>
                            </div>
                           <div class="row">
                              <div class="col-sm-12 col-md-12">
                                    <label class="form-label" for="notes" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">Upload a copy of your driver's license</label>
                                    <input class="form-control form-control-sm" type="file" name="license" id="license" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" required>
                               </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                      <label class="form-label" for="notes" style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">Upload a recent utility bill or NIN slip</label>
                                      <input class="form-control form-control-sm" type="file" name="utility_or_nin" id="utility" style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);" required>
                                 </div>
                                 <div class="col-md-12 mb-2">
                                    <div class="images-preview-div"> </div>
                              </div>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col" style="margin-top: 44px;">
                                    <h6 style="text-align: center;">What kind of vehicles can you drive?&nbsp;</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cars-suvs" id="formCheck-1" value="Cars and SUVs">
                                        <label class="form-check-label" for="formCheck-1" >Cars and SUVs</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="convoy" id="formCheck-2" value="Cars and SUVs (in convoy)">
                                        <label class="form-check-label" for="formCheck-2"> Cars and SUVs (in convoy)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="light_commercial" id="formCheck-3" value="Small to Medium Buses and Vans(e.g Toyota Hiace, 3 Ton Van)">
                                        <label class="form-check-label" for="formCheck-3" >Small to Medium Buses and Vans(e.g Toyota Hiace, 3 Ton Van)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="commercial" id="formCheck-4" value="Large Buses(e.g Coaster, Marco Polo)">
                                        <label class="form-check-label" for="formCheck-4">Large Buses(e.g Coaster, Marco Polo)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="trucks" id="formCheck-5" value="Trucks">
                                        <label class="form-check-label" for="formCheck-5">Trucks (e.g Flatbeds, Articulated, Container e.t.c)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="industrial" id="formCheck-6" value="Mobile Machinery(Cranes, Forklifts, Graders e.t.c)">
                                        <label class="form-check-label" for="formCheck-6">Mobile Machinery(Cranes, Forklifts, Graders e.t.c)</label>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label class="form-label" for="notes"
                                        style="font-size: 14px;color: var(--bs-gray-500);padding-top: 20px;">Notes</label>
                                    <input class="form-control form-control-sm" type="text" name="notes" id="notes" placeholder="Write any notes or details to support your application ..."
                                        style="border-top-style: none;border-right-style: none;border-left-style: none;border-radius: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius: 1px;background: rgba(255,255,255,0);">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--            <div class="col-sm-6" id="secondtab" style="padding: 50px;padding-top: 50px;padding-bottom: 50px;background: #ffffff;text-align: center;margin-top: 0px;"></div>--}}
        <div class="row">
            <div class="col-12 d-md-flex justify-content-center align-items-center align-content-center align-self-center justify-content-md-center" style="text-align: center;margin-top: 14px;padding-bottom: 17px;">
                <button class="btn btn-primary partner-driver-submit-butt" type="submit" style="width: 235.422px;background: rgb(52,63,95);">SUBMIT</button>
            </div>
        </div>
    </div>    
    <script>
        function updateexp(){
           var exp = document.getElementById('experience').value;
           document.getElementById('expvalue').innerHTML = exp;
        }
    </script>
    <script>
        $(function() {
            var previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $(imgPreviewPlaceholder).html($.parseHTML('<img>')).attr('src', event.target.result));
                            /*$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);*/
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#license').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
            $('#utility').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
        });

    </script>
    <script>
        $(document).ready(function(){
            $(".partner-button").click(function(){
                $(".partner_div").css("display", "block");
                $(".driver_div").css("display", "none");
                $(this).addClass("active");
                $(".driver-button").removeClass("active");
                $(".partner-driver-submit-butt").attr("form", "become_partner");
            })
        })
        $(".driver-button").click(function(){
                $(".partner_div").css("display", "none");
                $(".driver_div").css("display", "block");
                $(this).addClass("active");
                $(".partner-button").removeClass("active");
                $(".partner-driver-submit-butt").attr("form", "become_driver");
            })

    </script>
</section>  
@endsection  