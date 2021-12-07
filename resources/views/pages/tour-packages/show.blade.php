@extends('layouts.app')
<style>
    .booking_hero_text{
        display:grid;
        grid-template-columns: repeat(3, 1fr);
    }
    .boat-container{
        display:grid;
        grid-template-columns: repeat(12 , 1fr);
        margin-top: 5%;
        grid-gap: 40px;
    }
    .navigation{
        grid-column: 2/5;
        background: white;
        box-shadow:2px 2px 2px 2px rgba(219, 226, 241, 0.54);
        border-radius: 10px;
        padding:20px;
        max-height: 400px;
    }
    .boat_info_box{
        grid-column: 5/12;
        width:800px;
    }
    .overview{
        display:flex;
        margin-top:20px;
    }
    .overview h4:first-child{
        margin-right:20px;
        color:#111111;
        font-weight: bolder;
    }
    .overview h4:nth-child(2){
        color:#BDBDBD;
        font-weight: bolder;
    }
    .rating_duration_box{
        display:flex;
    }
    .rating{
        background: white;
        border: 1px solid #F2F2F2;
        border-radius: 10px;
        padding:5px;
        box-shadow:2px 2px 2px 2px rgba(219, 226, 241, 0.54);
    }
    .duration{
        background: white;
        border: 1px solid #F2F2F2;
        border-radius: 10px;
        padding:5px;
        box-shadow:2px 2px 2px 2px rgba(219, 226, 241, 0.54);
        margin-right: 20px;

    }
    .duration_box , .rating{
        display:flex;
    }
    .outer_circle{
        height:35px;
        width:35px;
        background: #DC6513;
        border-radius: 50%;
        margin-right:30px;

    }
    .boat_rating{
        margin-right:30px;
    }
    .inner_circle{
        height:25px;
        width:25px;
        border-radius: 50%;
        margin:auto;

    }
    .inner_circle img {
        margin-left:10px;
        margin-top:10px;
    }
    .duration_text h6:first-child{
        color:#BDBDBD;
        font-weight: bolder;
    }
    .duration_text h6:nth-child(2){
        color:#111111;
        font-weight: bolder;
    }
    .rating_text h6:first-child{
        color:#BDBDBD;
        font-weight: bolder;
    }

    .rating_text  h6:nth-child(2){
        color:#111111;
        font-weight: bolder;
    }
    .description{
        margin-top:20px;
    }
    .price_per_trip h6:first-child{
        color:#111111;
        font-weight: bolder;
    }
    .regular_class{
        display:flex;
        margin-bottom: 10px;
    }
    .regular_class span:first-child{
        color:#111111;
        font-weight: bolder;
    }
    .regular_class span:nth-child(2){
        color:#BDBDBD;
        font-weight: bolder;
    }
    .regular_input_field{
        margin-right: 40px;
    }
    .popular_cruise{
        margin-top:40px;
    }
    .popular_cruise h4:first-child{
        color:#111111;
        font-weight: bolder;
    }
    .popular_cruise_box{
        display:grid;
        grid-template-columns: repeat(6 , 1fr);
        grid-gap: 20px;
        overflow-x: scroll;
    }
    .boat_card{
        background: white;
        box-shadow:2px 2px 2px 2px rgba(219, 226, 241, 0.54);
        border-radius: 10px;
        width:400px;

    }
    .backgrund_img{
        position:relative;
    }
    .price_tag{
        position: absolute;
        top: 120px;
        right:25px;
    }

    .price_tag h5{
        color:white;
        font-weight: bolder;
    }
    .ratings_location{
        display:flex;
        justify-content: space-between;
    }
    .ratings_box{
        padding:15px;
    }
    .backgrund_img img {
        width:100%;
    }
    .add_payment{
        text-align: center;
        margin-top: 30px;
    }
    .add_payment button{
        background: #021037;
        color:white;
        padding:10px;
        border-radius: 5px;
        cursor:pointer;
    }
    .add_payment button:hover{
        background: #DC6513;
    }
    .carousel-container {
        width: 800px;
        height: 400px;
        position: relative;
    }
    .carousel-container {
        margin-top: 20px;
        transition: all 0.3s ease;

    }
    .carousel-container img {
        width: 100%;
        transition: all 0.3s ease;
        border:8px solid white;
    }

    .item {
        position: absolute;
        display: none;
    }

    .main {
        display: block;
    }
    .navigation-items .prev {
        position: absolute;
        z-index: 10;
        font-size: 25px;
        top: 40%;
        /*left: 100px;*/
        left: 10px;
        font-weight: 700;
    }
    .navigation-items .next {
        /*right: -250px;*/
        right: 10px;
        position: absolute;
        font-size: 25px;
        z-index: 10;
        top: 40%;
    }
    .navigation-items .nav-btn {
        background: rgba(255, 255, 255, 0.55);
        cursor: pointer;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.4);
    }
    .navigation-items .nav-btn:hover {
        background: white;
    }
</style>
@section('content')
    <div>
        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/tour.png')}}'); height:200px;" >
            <div class="booking_hero_text">
                <div class="booking_hero_icon">
                    <img src="{{asset('/images/icons/arrow_left_2.png')}}">
                </div>
                <div class="booking_text">
                    <h1>{{$service->name}}</h1>
                    <span>Lorem ipsum text here  Lorem ipsum text here Lorem ipsum text here</span>
                </div>
            </div>
        </div>
        <div class="boat-container">
            <div class="navigation">
                <h3>Filter search</h3>
            </div>
            <div class="boat_info_box">
                <div class="carousel-container">
                    @foreach($tour->tourimages as $img)
                    <div class="item main">
                        <img src="{{$img->path}}"  alt="'hero-img" />
                    </div>
                    @endforeach

                    <div class="navigation-items">
                        <div class="prev nav-btn"><</div>
                        <div class="next nav-btn">></div>
                    </div>
                </div>

                <div class="overview">
                    <h4>Overview</h4>
                    <h4>Review</h4>
                </div>
                <div class="rating_duration_box">
                    <div class="duration">
                        <div class="duration_box">
                            <div class="outer_circle">
                                <div class="inner_circle">
                                    <img src="{{ asset('/images/icons/duration.png')}}"   />
                                </div>
                            </div>
                            <div class="duration_text">
                                <h6>DURATION</h6>
                                <h6>4 Days</h6>
                            </div>
                        </div>
                    </div>
                    <div class="rating">
                        <div class="boat_rating">
                            <img src="{{ asset('/images/icons/boat_rating.png')}}"  width="35px" height="35px" />
                        </div>
                        <div class="rating_text">
                            <h6>DURATION</h6>
                            <h6>4 Days</h6>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p>{{$tour->description}}</p>
                </div>
                <div class="price_per_trip">
                    <h6>Price Per Trip</h6>
                    <form id="payment_plan" method="post" action="{{url('/tour/'.$tour->id.'/payment-plan/'.$service->id)}}">
                        @csrf
                        <fieldset id="payemtn_option">
                            <div class="regular_class">
                                <div class="regular_input_field"><input type="radio" value="{{$tour->amount_regular}}" name="amount" class="radioInput" /> Regular </div>
                                <div><span>&#x20A6;{{number_format($tour->amount_regular)}}</span> <span >per trip</span></div>
                            </div>
                            <div class="regular_class">
                                <div class="regular_input_field"><input type="radio" value="{{$tour->amount_standard}}" name="amount" class="radioInput"/> Standard </div>
                                <div><span>&#x20A6;{{number_format($tour->amount_standard)}}</span> <span >per trip</span></div>
                            </div>
                        </fieldset>
                </div>
                <div class="popular_cruise">
                    <h4>Popular Cruise</h4>
                    <div class="popular_cruise_box">
                        @for($i =0; $i < 5 ;$i++)
                            <div class="boat_card">
                                <div class="backgrund_img" >
                                    <img src="{{ asset('/images/bg/tour-thumb.png')}}" />
                                    <div class="price_tag">
                                        <h5>New Board</h5>
                                        <h5>500,000 - 600,000</h5>
                                    </div>
                                </div>

                                <div class="ratings_box" >
                                    <h5>Harmony of seas</h5>
                                    <small>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore mag
                                    </small>
                                    <div class="ratings_location">
                                        <div>
                                            <img src="{{asset('/images/icons/ratings.png')}}" alt="ratings-img"/>
                                            <small>4.7/5 Ratings</small>
                                        </div>
                                        <div>
                                            <img src="{{asset('/images/icons/location.png')}}" alt="location-img"/>
                                            <small>Los Angeles , USA</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="add_payment">
                    <button type="submit" form="payment_plan">Continue To Payment</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        const prev = document.querySelector('.prev');
        const next = document.querySelector('.next');
        const images = document.querySelector('.carousel-container').children;
        const totalImages = images.length;
        let index = 0;

        prev.addEventListener('click', () => {
            nextImage('next');
        })

        next.addEventListener('click', () => {
            nextImage('prev');
        })

        function nextImage(direction) {
            if(direction == 'next') {
                index++;
                if(index == totalImages) {
                    index = 0;
                }
            } else {
                if(index == 0) {
                    index = totalImages - 1;
                } else {
                    index--;
                }
            }

            for(let i = 0; i < images.length; i++) {
                images[i].classList.remove('main');
            }
            images[index].classList.add('main');
        }
    </script>
@endsection
