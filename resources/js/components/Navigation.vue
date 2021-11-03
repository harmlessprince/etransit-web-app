<template>
    <div>
       <header class="navigation-header">
            <div class="nav-content">
                <div class="socials-block">
                    <div class="social-icons">
<!--                        <img :src="'/images/socials/facebook.png'"  alt="facebook-img"/>-->
<!--                        <img :src="'/images/socials/linkedin.png'"  alt="linkedin-img"/>-->
<!--                        <img :src="'/images/socials/google.png'"  alt="google-plus-img"/>-->
                    </div>
<!--                    <div class="breaker">-->
<!--                    </div>-->
                    <div class="email-container">
                        <span>example@email.com</span>
                    </div>
                </div>
                <div class="currency-block">
                    <span>NGN</span>
                    <span>English</span>
                    <button class="login">Log In</button>
                    <button class="sign-up">Sign Up</button>
                </div>
            </div>
       </header>
        <nav class="bottom-nav">
          <div class="logo">
              <img  :src="'/images/logo/et-logo.png'" alt="Etransit-logo"/>
          </div>
          <div class="nav-menu">
              <ul>
                  <li><router-link to="/"> Home </router-link></li>
                  <li><router-link to="/"> About Us </router-link></li>
                  <li><router-link to="/"> Tour Packages </router-link></li>
                  <li><router-link to="/"> Boat Cruise </router-link></li>
                  <li><router-link to="/"> Hotel Bookings </router-link></li>
                  <li><router-link to="/"> Become A Partner </router-link></li>
                  <li><router-link to="/"> Send Parcel </router-link></li>
              </ul>
          </div>
        </nav>
    </div>
</template>
<script>
export default {

}
</script>
<style scoped>
.navigation-header
{
    background: #021037;
    height: 60px;
    opacity: 0.8;
    top:0;
    left:0;
}
.nav-content{
    display: flex;
    justify-content: space-around;
}
.email-container span{
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    line-height: 2.6em !important;
    /* identical to box height */
    color: #FFFFFF;
}
.social-icons img{
    height:25px;
    width: 15px;
    margin-left:2px;
    line-height: 2.6em !important;
    margin-top:  15px;
}
.socials-block{
    display:flex;
}
.breaker{
    border: 1px solid #fff;
    height: 20px;
}
.currency-block span  {
    /*width: 28px;*/
    font-weight: bold;
    line-height: 2.6em !important;
    margin:10px;
    font-size: 18px;
    color: #FFFFFF;
}
.login{

    color: #fff;
    background: #DC6513;
    border-radius: 5px;
    border: 1px solid #DC6513;
    cursor:pointer;
    width:90px;
    margin-right:10px;
}
.sign-up{
    background: #021037;
    opacity: 0.8;
    border: 1px solid #DC6513;
    color:#fff;
    border-radius: 5px;
    width:90px;
}
.bottom-nav{
    background: #F2F2F2;
    height: 79px;
    display: flex;
    justify-content: space-around;
}
.logo img{
    margin-top: 10px;
}
.nav-menu ul{
    list-style: none;
    display:flex;
}
.nav-menu ul li {
    font-style: normal;
    font-weight: bold;
    font-size: 18px;
    /*line-height: 21px;*/
    margin: 15px  10px 0px 10px;
    color:#828282;

}

</style>
