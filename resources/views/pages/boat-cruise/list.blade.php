@extends('layouts.app')
<style>
    .booking_hero_text{
        display:grid;
        grid-template-columns: repeat(3, 1fr);
    }
    .boat_cruise_box{
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        margin-top:3%;
    }
    .navigation{
        grid-column: 1/4;
        margin-left: 20%;
        background: white;
        box-shadow:2px 2px 2px 2px rgba(219, 226, 241, 0.54);
        border-radius: 10px;
        padding:20px;
        max-height: 500px;

    }
    .boat_list{
        grid-column: 6/12;
    }
    .nav_header{
        display:flex;
        justify-content: space-between;
    }
    .search_text{
        background: #F4F4F4;
        border: 1px solid #F4F4F4;
        padding:10px;
        border-radius: 5px;
        width: 40%;
    }
    .boat_card{
        background: white;
        box-shadow:2px 2px 2px 2px rgba(219, 226, 241, 0.54);
        border-radius: 10px;


    }
    .boat_cruise_list{
        display:grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap:50px;
        margin-top: 40px;
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
    <div class="boat_cruise_box">
        <div class="navigation">
            <div class="nav_header">
                <h5>Filter Search</h5>
                <span>Clear</span>
            </div>
            <hr>
        </div>
        <div class="boat_list">
           <div>
               <h3>Available Cruise</h3>
           </div>
            <div>
                <input type="text" placeholder="search"  class="search_text"/>
            </div>
            <div class="boat_cruise_list">
               @for($i=0;$i < 4 ; $i++)
                    <div class="boat_card">
                        <div class="backgrund_img" >
                            <img src="{{ asset('/images/bg/mini_boat.png')}}" />
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
    </div>
</div>

@endsection
