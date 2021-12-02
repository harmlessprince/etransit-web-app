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
        top: 620px;
        left: 990px;
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

</style>
@section('content')
    <div>
        <div class="booking_bg"  style="background-image: url('{{ asset('/images/bg/boat_cruise.png')}}'); height:200px;" >
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
                <img src="{{ asset('/images/bg/boat.png')}}"  width="1000px" />
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="price_per_trip">
                    <h6>Price Per Trip</h6>
                    <div class="regular_class">
                        <div class="regular_input_field"><input type="checkbox" /> Regular </div>
                        <div><span>N40,000</span> <span >per trip</span></div>
                    </div>
                    <div class="regular_class">
                        <div class="regular_input_field"><input type="checkbox" /> Standard </div>
                        <div><span>N40,000</span> <span >per trip</span></div>
                    </div>
                </div>
                <div class="popular_cruise">
                    <h4>Popular Cruise</h4>
                    <div class="popular_cruise_box">
                        @for($i =0; $i < 5 ;$i++)
                            <div class="boat_card">
                                <div class="backgrund_img" >
                                    <img src="{{ asset('/images/bg/mini_boat.png')}}" />
                                </div>
{{--                                <div class="price_tag">--}}
{{--                                    <h5>New Board</h5>--}}
{{--                                    <h5>500,000 - 600,000</h5>--}}
{{--                                </div>--}}
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
                    <button>Continue To Payment</button>
                </div>
            </div>

        </div>
    </div>

@endsection
