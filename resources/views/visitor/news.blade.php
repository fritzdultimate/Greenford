@include('visitor.template.header')
    <!-- Page Title -->
    <section class="page-title pb-0" style="background-image: url({{ asset('assets/images/background/bg-19.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="content-wrapper">
                    <div class="title">
                        <h1>Daily News</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>News</li>
                    </ul>
                </div>                    
            </div>
        </div>
        
    </section>
    <!-- Page Title -->

    <!-- Faq Section Three -->
    <section class="faq-section-three">
        <div class="auto-container">
            <div class="row">
                <div class="col-md-6">
                        <h3 class="title-about">Other Currency News</h3>
                        <a class="fx-widget" data-widget="newsfeed" data-lang="en" data-post-date-color="#999" data-post-description-color="#ffffff" data-post-title-color="#ffffff" data-widget-bg-color="#111111" data-show-image data-width="650" data-height="855" data-show-date data-title-font-size="18" data-intro-font-size="16" data-category="news" data-section="currencies" data-base-url="https://www.fxempire.com" data-url="https://www.fxempire.com" href="https://www.fxempire.com/" rel="nofollow" style="font-family:Helvetica;font-size:16px;line-height:1.5;text-decoration:none;"> 
                            <span style="color:#999999;display:inline-block;margin-top:10px;font-size:12px; opacity: 0;">Powered By </span> <img style="width:87px; height:14px; opacity: 0;" src="https://www.fxempire.com/logo-full.svg" alt="FX Empire logo" /> </a> 
                            <script async charset="utf-8" src="https://widgets.fxempire.com/widget.js" ></script> 
                    </div>
                    <div class="col-md-6 ml-lg-auto">
                        <h3 class="title-about">Cryptocurrency News</h3>
                        <a class="fx-widget" data-widget="newsfeed" data-lang="en" data-post-date-color="#999" data-post-description-color="#333333" data-post-title-color="#ffffff" data-widget-bg-color="#111111" data-show-image data-width="650" data-height="855" data-show-date data-title-font-size="18" data-intro-font-size="16" data-category="forecasts" data-section="cryptocurrencies" data-base-url="https://www.fxempire.com" data-url="//www.fxempire.com" href="https://www.fxempire.com/" rel="nofollow" style="font-family:Helvetica;font-size:16px;line-height:1.5;text-decoration:none;"> <span style="color:#999999;display:inline-block;margin-top:10px;font-size:12px; opacity: 0;">Powered By </span> <img style="width:87px; height:14px; opacity: 0;" src="https://www.fxempire.com/logo-full.svg" alt="FX Empire logo" /> </a> <script async charset="utf-8" src="../widgets.fxempire.com/widget.js" ></script> 
                    </div>
                
            </div>
        </div>
    </section>

    <!-- Feature Section Two -->
    <section class="feature-section-two">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-6 feature-block-two style-two">
                    <div class="shape-box">
                        <div class="inner-box">
                            <div class="icon"><img src="assets/images/icons/icon-9.png') }}" alt=""></div>
                            <h4>Become a Partner of {{ env("SITE_NAME") }}</h4>
                            <div class="text">To take a trivial example, which of us undertakes <br>laborious physical exercise.</div>
                        </div>
                    </div>
                        
                </div>
                <div class="col-lg-6 feature-block-two style-two">
                    <div class="shape-box">
                        <div class="inner-box">
                            <div class="icon"><img src="assets/images/icons/icon-10.png') }}" alt=""></div>
                            <h4>Career Opportunities in {{ env("SITE_NAME") }}</h4>
                            <div class="text">Who chooses to enjoy a pleasure that has no one <br>annoying consequences.</div>
                        </div>
                    </div>               
                </div>
            </div>
        </div>
    </section>
@include('visitor.template.footer')