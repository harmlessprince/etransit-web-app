<template>
    <div>
        <div class="footer_box">
            <div class="newsletter_box">
                <div class="more_update">
                    <h2>GET UPDATES AND MORE</h2>
                    <P>THOUGHTFUL THOUGHTS TO YOUR INBOX</P>
                </div>
                <div class="newsletter_form">
                    <form>
                        <input type="email" name="newsletter"placeholder="YOUR EMAIL" class="newsletter" id="newsletter"/>
                        <button class="subscribe_button">SUBSCRIBE</button>
                    </form>
                </div>
            </div>
            <div class="footer_bottom" :style="{'background-image':'url(/images/bg/footer_bg.png)'}">
                <div class="footer_menus">
                    <div class="footer_menu_item">
                        <h3>NEED HELP ? </h3>
                        <div class="footer_contacts">
                            <h6>CALL US</h6>
                            <span>080 6430 4717</span>
                        </div>
                        <div class="footer_contacts">
                            <h6>EMAIL</h6>
                            <span>hello@etransitafrica.com</span>
                        </div>
                    </div>
                    <div class="footer_menu_item">
                        <h3>COMPANY</h3>
                        <div class="sub_footer_menu">
                           <ul>
                               <li>ABOUT US</li>
                               <li>COMMUNITY BLOG</li>
                               <li>REWARDS</li>
                               <li>WORK WITH US</li>
                               <li>MEET THE TEAM</li>
                           </ul>
                        </div>
                    </div>
                    <div class="footer_menu_item">
                        <h3>SUPPORT</h3>
                        <div class="sub_footer_menu">
                            <ul>
                                <li>ACCOUNT</li>
                                <li>LEGAL</li>
                                <li>CONTACT</li>
                                <li>AFFILIATE PROGRAM</li>
                                <li>PRIVACY POLICY</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="socials_menu">
                    <h3>FOLLOW US ON</h3>
                    <div class="social_images">
                        <img  :src="'/images/socials/twitter_2.png'" alt="image"  class="socials_icon" />
                        <img  :src="'/images/socials/facebook_2.png'" alt="image"   class="socials_icon"/>
                        <img  :src="'/images/socials/youtube_2.png'" alt="image"   class="socials_icon" />
                        <img  :src="'/images/socials/instagram_2.png'" alt="image"   class="socials_icon"/>
                    </div>
                </div>
                <div class="copyright_section">
                    <div> <h5>Copyright 2021 by E-Transit Africa</h5> </div>
                    <div> <h5>Powered By: <span>MyAppSpace</span></h5></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

</script>
<style scoped>
.footer_box{
    margin-top: 100px;
}
.newsletter_box{
    background: #fff !important;
    padding: 50px;
    display:flex;
    justify-content: space-around;
}
.newsletter{
    background:transparent;
    border: none ;
    width:400px !important;
    padding: 10px;
    border-bottom:1px solid grey;
}
.subscribe_button{
    background: #DC6513;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
}
.newsletter_form{
    margin-top: 25px;
}
.footer_menus , .socials_menu{
    display:flex;
    justify-content: space-around;


}
.footer_bottom{
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height:700px;
    margin-top: -28px;
}

.footer_menu_item h3{
    font-weight: 800;
    font-size: 30px;
    line-height: 20px;
    letter-spacing: -0.02em;
    color: #DC6513;
    margin-top: 120px !important;
}

.footer_menu_item h6{
    color:white;
}
.sub_footer_menu ul {
    font-size: 16px;
    color: white;
    list-style:none;
    margin-bottom: 10px;
}
.sub_footer_menu ul li:first-child{
    margin-top: 40px;
}

.sub_footer_menu ul li{
    margin-bottom: 20px;
    font-weight: bolder;
}
.footer_contacts h6:first-child{
    margin-top: 40px;
    font-size: 18px;
}
.footer_contacts span{
    font-size: 18px;
    color:white;
}
.socials_menu{
    display:flex;
    flex-direction: column;
    margin-left: 210px;
}
.socials_menu h3{
    color: white;
    margin-buttom:30px;
}
.socials_icon{
    margin-right:10px;
}
.copyright_section{
   display: flex;
    justify-content: space-between;

}
.copyright_section h5{
    color:white;
    margin-top: 180px;
    margin-left:  70px;
    margin-right:70px ;

}

.copyright_section h5 span{
    color: #DC6513;

}


</style>
