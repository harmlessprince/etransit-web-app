
    <footer class="footer_box">
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
        <div class="footer_bottom" >
{{--            :style="{'background-image':'url(/images/bg/footer_bg.png)'}"--}}
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
                    <img  src="{{asset('images/socials/twitter_2.png')}}" alt="image"  class="socials_icon" />
                    <img  src="{{asset('images/socials/facebook_2.png')}}" alt="image"   class="socials_icon"/>
                    <img  src="{{asset('images/socials/youtube_2.png')}}" alt="image"   class="socials_icon" />
                    <img  src="{{asset('images/socials/instagram_2.png')}}" alt="image"   class="socials_icon"/>
                </div>
            </div>
            <div class="copyright_section">
                <div> <h5>Copyright 2021 by E-Transit Africa</h5> </div>
                <div> <h5 class="powered_by">Powered By: <span>MyAppSpace</span></h5></div>
            </div>
        </div>
        @jquery
        @toastr_js
        @toastr_render
    </footer>


