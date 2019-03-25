<footer class="footer-area section-padding-60-0">
    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row align-items-baseline justify-content-between">
                <!-- Single Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Footer Logo -->
                    <a href="{{route('home.index')}}"><img src="{{asset(getConfig('favicon_frontend'))}}" alt="logo" class="footer-logo"></a>
                </div>

                <!-- Single Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-5">
                    <div class="single-footer-widget mb-80">
                        <h5 class="widget-title">{{getConstant('APP_NAME')}}</h5>

                        <h4>{{getConfig('contact.phone')}}</h4>
                        <span>{{getConfig('contact.email')}}</span>
                        <span>{{getConfig('contact.address')}}</span>
                    </div>
                </div>

                <!-- Single Footer Widget Area -->
                <div class="col-6 col-xs-6 col-sm-6 col-lg-2">
                    <div class="single-footer-widget mb-80">
                        <!-- Widget Title -->
                        <h5 class="widget-title">{{transa('links')}}</h5>

                        <!-- Footer Nav -->
                        <ul class="footer-nav">
                            <li><a href="{{route('home.community')}}">{{transa('community')}}</a></li>                                
                            <li><a href="#">{{transa('feedback')}}</a></li>
                            @if (!frontendGuard()->check())
                            	<li><a href="{{route('frontend.register')}}">{{transa('register')}}</a></li>
                        	@else
                        		<li><a href="{{route('frontend.posts.create')}}"> {{transa('post')}}</a></li>
                        	@endif
                        </ul>
                    </div>
                </div>

                <!-- Single Footer Widget Area -->
                <div class="col-6 col-xs-6 col-sm-6 col-lg-2">
                    <div class="single-footer-widget mb-80">
                        <h5 class="widget-title">{{transa('info')}}</h5>

                        <!-- Footer Nav -->
                        <ul class="footer-nav">
                        	<li><a href="#">{{transa('introduce')}}</a></li>
                        	<li><a href="#">{{transa('use')}}</a></li>
                        	<li><a href="#">{{transa('terms_of_service')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copywrite Area -->
    <div class="container">
        <div class="copywrite-content">
            <div class="row align-items-center">
                <div class="col-12 col-md-8">
                    <!-- Copywrite Text -->
                    <div class="copywrite-text">
                        <p>Copyright © 2019 <a href="https://colorlib.com" target="_blank" style="color: #1cc3b2;">{{getConstant('BACKEND_NAME')}}</a>. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <!-- Social Info -->
                    <div class="social-info">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>