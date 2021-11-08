<template>
    <div  class="hero-bg">
        <img  :src="'/images/bg/hero-bg.png'" alt="image"  class="hero-bg-image" />
<!--        :style="{'background-image':'url(/images/bg/hero-bg.png)'}"-->
        <div class="hero-bg-section">
            <div class="hero-bg-text">
                <p>Our 24 Hour's Service</p>
                <h1>EASY , SAFE AND CONVENIENT </h1>
                <small>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. <br> Richard McClintock, a Latin professor at Hampden-Sydney College i</small>
            </div>
        </div>
        <div class="ticketing-section">
            <div class="ticketing-box">
                <div class="ticket-box-menu">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Bus Booking</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Train Ticket</a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Ferry Booking</a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Flight Booking</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="bus-booking-box">
                                <div class="bus-booking-content">
                                    <form>
                                        <div class="booking-trip-button">
                                            <button>One Way</button>
                                            <button>Round Trip</button>
                                        </div>
                                        <div class="departure_box">
                                            <div class="bus-booking-departure-date">
                                                <div class="date_picker">
                                                    <label for="departure" class="departure_label">Departure Date</label>
                                                    <input type="date" name="departure_date" id="departure"/>
                                                </div>
                                                <div class="departure_day_box">
                                                    <span class="departure_day">TODAY | TOMORROW </span>
                                                </div>
                                            </div>
                                            <div class="number_of_passengers">
                                                <label for="number_of_persons" class="departure_count">NUMBER OF PERSONS</label>
                                                <select id="number_of_persons" class="passengers" name="number_of_seats">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p>LOCATION</p>
                                        <div>
                                            <div class="travelling_select_box">
                                                <div class="travelling_from_box">
                                                    <label for="travelling_from" class="departure_label">Travelling Frome</label>
                                                    <select name="departure_date" id="travelling_from">
                                                        <option>Lagos</option>
                                                        <option>Abuja</option>
                                                    </select>
                                                </div>
                                                <div class="travelling_to_box">
                                                    <label for="travelling_to" class="travelling_to_label">Travelling To</label>
                                                    <select name="travel_to" id="travelling_to">
                                                        <option>Lagos</option>
                                                        <option>Abuja</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="proceed_button_box">
                                               <button class="proceed_button">PROCEED</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">... hxhxhxhhxhx</div>
                        <div role="tabpanel" class="tab-pane" id="messages">..aaaaaaa.</div>
                        <div role="tabpanel" class="tab-pane" id="settings">...aaanananana</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_us">
               <div>
                   <h1>ABOUT US</h1>
                   <h4>WELCOME TO E-TRANSIT</h4>
               </div>
        </div>
        <div class="about_us_box">
               <div>
                   <div class="about_us_content">
                       <div>
                           <h5>ABOUT <br/> E-TRANSIT</h5>
                       </div>
                       <div>
                           <p class="about_paragragh">
                               Etransit Africa is an African-focused transportation service company that exists
                               to provide individuals
                               and cooperate bodies with satisfactory
                               transportation services on a timely and consistent basis.
                           </p>
                           <p class="about_paragragh"> The company started operations in 2019 as an interstate transport company in Nigeria but projects
                               to provide transportation services across Africa. Our team of highly trained professionals are always
                               working towards making each travel experience worth every penny.
                               Read more
                           </p>
                       </div>

                   </div>
                   <div class="about_us_content">
                       <div>
                           <h5>WHY <br/> CHOOSE US ?</h5>
                       </div>
                       <div>
                           <h6>SAVE MORE</h6>
                           <p class="why_choose_us">Get the best affordable rates. Book your trips with us today</p>
                           <h6>RELIABLE</h6>
                           <p class="why_choose_us"> Don’t get stuck with the rest, journey with the best.</p>
                           <h6>GREAT FEEDBACK</h6>
                           <p class="why_choose_us">Your safety and comfort is our number one priority</p>
                       </div>
                   </div>
               </div>
                <div>
                    <img :src="'/images/about-us/about-us.png'" alt="about-us-image"  class="about_us_img" height="400px"/>
                </div>
        </div>
        <div class="discount_bg">
            <div>
                <img :src="'/images/discount/discount_bus.png'" alt="about-us-image" class="discount_bus_img" height="350px"/>
            </div>
            <div class="discount_text">
                    <div>
                        <p>ENJOY</p>
                        <h3>30%</h3>
                        <h3 style="margin-left:-35px;">Discount</h3>
                        <span>ON</span>
                        <p style="margin-left:5px;">YOUR</p>
                        <p style="margin-left:-35px;">INTERSTATE TRIP</p>
                        <button class="get_started_btn">GET STARTED</button>
                    </div>
            </div>
            <div>
                <img :src="'/images/discount/discount_plane.png'" alt="about-us-image" class="discount_plane_img" height="300px" />
            </div>
        </div>
        <div class="trending_vehicle_section">
           <div class="trending_header_text">
               <div>
                   <h3>TRENDING VEHICLES</h3>
                   <p> BOOK EXCLUSIVE VEHICLES TO MOVE YOU AROUND</p>
               </div>
           </div>
            <div class="trending_vehicle_items">
                <div class="trending_vehicle_item">
                    <div class="vehicle_image">
                        <img :src="'/images/trending/vehicle.png'" alt="about-us-image" class="discount_plane_img" height="300px" />
                    </div>
                    <div class="vehicle_name">
                        <p>Lexus RX 360</p>
                    </div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/auto.png'" alt="auto-image"  class="auto-icons" height="20px"/> </div>
                            <div><p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/seater.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/functional.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
                <div class="trending_vehicle_item">
                    <div class="vehicle_image"><img :src="'/images/trending/vehicle.png'" alt="about-us-image" class="discount_plane_img" height="300px" /></div>
                    <div class="vehicle_name"><p>Lexus RX 360</p></div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/auto.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/seater.png'" alt="auto-image"  class="auto-icons" height="20px"/> </div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/functional.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
                <div class="trending_vehicle_item">
                    <div class="vehicle_image">
                        <img :src="'/images/trending/vehicle.png'" alt="about-us-image" class="discount_plane_img" height="300px" />
                    </div>
                    <div class="vehicle_name">
                        <p>Lexus RX 360</p>
                    </div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/auto.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div> <p>Auto</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/seater.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/functional.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
                <div class="trending_vehicle_item">
                    <div class="vehicle_image">
                        <img :src="'/images/trending/vehicle.png'" alt="about-us-image" class="discount_plane_img" height="300px" />
                    </div>
                    <div class="vehicle_name">
                        <p>Lexus RX 360</p>
                    </div>
                    <div class="vehicle_functionalities">
                        <div class="vehicle_function">
                              <div><img :src="'/images/icons/auto.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                              <div> <p>Auto</p> </div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/seater.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p> 7 Seater(s)</p></div>
                        </div>
                        <div class="vehicle_function">
                            <div><img :src="'/images/icons/functional.png'" alt="auto-image"  class="auto-icons" height="20px"/></div>
                            <div><p>Functional</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="client_section">
            <div class="clients">
               <div class="client_header_text">
                   <h3>SOME HAPPY CLIENTS</h3>
               </div>
                <div class="client_logo">
                    <div>
                        <img :src="'/images/clients/client_1.png'" alt="client-image" class="client_img" height="150" />
                    </div>
                    <div>
                        <img :src="'/images/clients/client_2.png'" alt="client-image"  class="client_img" height="150"/>
                    </div>
                    <div>
                        <img :src="'/images/clients/client_3.png'" alt="client-image" class="client_img"   />
                    </div>
                    <div>
                        <img :src="'/images/clients/client_4.png'" alt="client-image" class="client_img" height="150" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>

export default {


}
</script>
<style scoped>

.hero-bg-section{
    position: relative;
}
.hero-bg img{
    width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}
.hero-bg-text{
    position:absolute;
    top: -600px;
    text-align: center;
    left: 500px;
    font-style: normal;
    /* identical to box height */
    letter-spacing: -0.02em;
    color: #FFFFFF;
}
.hero-bg-text p{
    font-weight: 600;
    font-size: 19px;
    line-height: 19px;
    /* identical to box height */
    letter-spacing: -0.02em;
}
.ticket-box-menu ul li a{

    padding: 30px;
    font-size: 30px;
    color: #021037;
}
.ticket-box-menu ul li a:hover{
    padding: 30px;
    font-size: 30px;
    background: #021037;
    color: #DC6513;

}
.hero-bg-text h1{
    font-weight: 800;
    font-size: 38px;
    line-height: 38px;
}

.ticketing-section{
    position: relative;
    display: flex;
    justify-content: center;
    height: 450px;

}
.ticketing-box {
    padding:20px;
    position: absolute;
    top: -150px;
    background: #FFFFFF;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-radius: 15px;
    width: 1024px;
    height: 500px;

}
.bus-booking-box{
    margin-top:20px;
}
.booking-trip-button button{
    width:150px;
    background: #F2F2F2;
    height: 50px;
    border: 1px solid #F2F2F2;
}
.booking-trip-button button:hover{
    width:150px;
    background:  #03174C;
    height: 50px;
    border: 1px solid  #03174C;
    color:#fff;
}
.bus-booking-departure-date , .departure_box{
    display: flex;
    justify-content: space-between;
    margin-top:20px;
}
.bus-booking-departure-date .date_picker{
    display:flex;
    flex-direction: column;
}
.departure_count  , .departure_day  , .departure_label {
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 12px;
    color: #4F4F4F;

}
.departure_count{
    margin-right:10px;
}
#departure , #destination{
    width:350px;
    margin-top:20px;
    padding: 10px;
    border: none;
    background: #FFFFFF;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-radius: 15px;
    border-bottom:1px solid #E0E0E0;
}
#travelling_from{
    width:350px;
    margin-top:20px;
    padding: 10px;
    border: none;
    background: #FFFFFF;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-radius: 8px;
    border-bottom:1px solid #E0E0E0;
    margin-right: 15px;
}
#travelling_to{
    width:350px;
    margin-top:12px;
    padding: 10px;
    border: none;
    background: #FFFFFF;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-radius: 8px;
    border-bottom:1px solid #E0E0E0;
}
#departure:hover , .departure_day_box:hover{
    border-bottom:1px solid  #FFAB72;
}
.departure_day_box{
    margin-top: 38px;
    background: #fff;
    padding: 8px;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-radius: 10px;
    border-bottom:1px solid #E0E0E0;
    width:250px !important;
    text-align: center;
    margin-left:10px;


}
.number_of_passengers{
    display:flex;
    flex-direction: column;
    margin-top:20px;
}
.passengers{
    margin-top: 30px;
    background: #fff;
    padding: 5px;
    border: none;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-bottom:1px solid #E0E0E0;
    width:100px !important;
    text-align: center;
}
.travelling_select_box{
    display:flex;
    flex-direction: row;
}
.travelling_from_box , .travelling_to_box{
    display: flex;
    flex-direction: column;
}
.proceed_button{
    background: #03174C;
    border-radius: 5px;
    color:white;
    padding:10px;
    width: 100px;
    margin-top:20px;
}
.proceed_button_box{
    display: flex;
    justify-content: flex-end;
}
.about_us{
    display:flex;
    justify-content: center;
}
.about_us h1{
    color: #03174C;
    font-weight: bolder;
}

.about_us h4{
    color: #333333;
    margin-left: -20px;
}
.about_us_content{
    display: flex;
    margin-left:300px;
    width: 200px;
    margin-top: 30px;
}
.about_us_content h5{
    width:200px;
}
.about_us_content .about_paragragh{
    width: 443px;
    height: 90px;
}

.about_us_img {
    width: 800px !important;
    margin-top: 30px;
}
.about_us_box{
    display:flex;
    justify-content:space-between;
}
.why_choose_us{
    width: 443px;
}
.discount_bg{
    margin-top: 40px;
    background: #03174C;
    display:flex;
    justify-content: space-between;
    height: 300px;
}
.discount_bus_img{
    width: 400px !important;
    margin-top:40px;
}
.discount_text{
    margin-top: 30px;
}
.discount_text p{
    color:#fff;
    font-size:16px;

}
.discount_text h3{
    color:#fff;
    margin-top: -8px;
    font-size:30px;
}

.discount_text span{
    color:#fff;
    margin-left: 15px;
    font-size: 18px;
}

.discount_text p:first-child{
    margin-left:5px;
}
.get_started_btn{
    background: #DC6513;
    color:#fff;
    padding: 10px;
    margin-left: -25px;
    border-radius: 5px;
}
.discount_plane_img{
    width:1000px !important;
}
.trending_vehicle_items{
    display:flex;
}

.trending_vehicle_section{
    margin-top: 150px;
}
.trending_vehicle_items{
    width:1600px;
    overflow: scroll;
}
.trending_header_text{
    display: flex;
    justify-content: center;
}
.trending_header_text p{
    margin-left: -50px;
}
.trending_vehicle_item{
    background: #fff !important;
    box-shadow: 0px 3px 20px rgba(209, 209, 209, 0.38);
    border-radius: 10px;
    padding: 30px;
    margin: 30px;
}

.trending_vehicle_item:hover{
  border: 1px solid  #DC6513;
}
.vehicle_image img{
    width: 350px !important;
    height: 150px !important;
}
.vehicle_name{
    margin-top: 15px;
    font-weight: bold;
    font-size: 20px;
}
.auto-icons{
    width:20px !important;
}
.vehicle_function {
    display: flex;
    flex-direction: row;
    margin-right:10px;
}

.vehicle_function img{
    margin-right:20px;
}
.vehicle_functionalities{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 20px;

}
.client_section{
    background: #F8F8F8;
    margin-top: 50px;
    padding: 40px;
}
.client_header_text{
    display: flex;
    justify-content: center;
}
.client_header_text h3{
    margin-top:10px;
}
.client_img{
   width: 150px !important;
}
.client_logo{
    display:flex;
    justify-content: space-evenly;
    margin-top: 20px;
}
</style>


