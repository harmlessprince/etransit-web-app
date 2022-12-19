@extends('layouts.app')
@section('content')


    <section id="about" class="about" style="background: transparent; color: black; margin-top: 150px;margin-bottom: 100px;">
        <div class="container">

            <div class="row no-gutters">
                <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-right">
                    <div class="content">
                        <h3 class="text-black">What is Etransit?</h3>
                        <p class="text-justify">
                            Etransit Africa is an African-focused transportation service company that exists to provide individuals and cooperate bodies with satisfactory transportation services on a timely and consistent basis. The company started operations in 2019 as an interstate transport company in Nigeria but projects to provide transportation services across Africa. Our team of highly trained professionals are always working towards making each travel experience worth every penny. Read more
                        </p>
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-left">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-receipt"></i>
                                <h4>Save More</h4>
                                <p>Enjoy value for your money. We have the best prices across transit, flights and vehicle hire bookings.</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-cube-alt"></i>
                                <h4>Reliable</h4>
                                <p>Say goodbye to delays and cancellations.
                                    With real-time tech-enabled monitoring and thousands of vehicles and routes at our diposal, we'll never leave you stranded.</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-images"></i>
                                <h4>Seamless</h4>
                                <p>Hire Vehicles,book bus,train or flight tickets, boat cruises and more with a few clicks via our web and mobile apps.</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                <i class="bx bx-shield"></i>
                                <h4>Safe and Secure</h4>
                                <p>Our state of the art trip monitoring and tracking keep you safe when you use any of our services.</p>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <section class="align-content-center justify-content-center">
        <div class="about_img_2">
            <div><img class="w-100" src="{{asset('images/about-us/about-us.png')}}" alt="about-us-image"/></div>
        </div>
    </section>
@endsection
