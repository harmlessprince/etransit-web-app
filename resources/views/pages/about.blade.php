@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="header_text text-center" id="about_us_section">
            <div><h3>ABOUT US</h3></div>
        </div>
        <div class="header_text_2 mt-3">
            <div><p>WELCOME TO E-TRANSIT </p></div>
        </div>

        <div class="about_us_box">

            <div class="about_us_box_2">
                <div class="abouts_header_2_box">
                    <div class="about_etransit_2">
                        <div><h6>About E-TRANSIT</h6></div>
                    </div>
                    <div class="why_etransit_2">
                        <div><h6>WHY CHOOSE US ?</h6></div>
                    </div>
                </div>
                <div class="about_us_dot">
                    <div class="round_dot"></div>
                    <div class="round_inner_dot"></div>
                </div>
                <div class="content">
                    <div class="content_text text-justify">
                        <p class="text-justify">Etransit Africa is an African-focused transportation service company that exists to provide

                            individuals and cooperate bodies with satisfactory transportation services on a timely and

                            consistent basis.

                            The company started operations in 2019 as an interstate transport company in Nigeria but
                            projects

                            to provide transportation services across Africa. Our team of highly trained professionals
                            are always

                            working towards making each travel experience worth every penny.

                            Read more</p>
                    </div>
                    <div class="save_more_box">
                        <h6>SAVE MORE</h6>
                        <P>Get the best affordable rates. Book your trips with us today</P>
                        <h6>RELIABLE</h6>
                        <P>Don’t get stuck with the rest, journey with the best.</P>
                        <h6>GREAT FEEDBACK</h6>
                        <P>Your safety and comfort is our number one priority</P>
                    </div>
                </div>
                <div class="about_img_2">
                    <div><img src="{{asset('images/about-us/about-us.png')}}" alt="about-us-image"/></div>
                </div>

            </div>
        </div>
    </div>
@endsection
