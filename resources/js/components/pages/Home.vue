<template>
    <div  class="hero-bg">
        <img :src="'/images/bg/hero-bg.png'" alt="image" />
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



    </div>

</template>
<script>

export default {


}
</script>
<style scoped>
/*.hero-bg{*/
/*    background-image: url('https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072821_1280.jpg');*/
/*}*/
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
#departure{
    width:350px;
    margin-top:20px;
    padding: 10px;
    border: none;
    background: #FFFFFF;
    box-shadow: 0px 4px 30px rgba(187, 187, 187, 0.33);
    border-radius: 15px;
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

</style>


