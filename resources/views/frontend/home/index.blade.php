<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>{{getConstant('APP_NAME')}}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ url('images/favicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="{{asset('css/vendor/bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/animate.css')}}">
	<link rel="stylesheet" href="{{asset('css/frontend/classy-nav.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/style.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/vendor/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend/custom.css')}}">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Top Header Area Start -->
        <div class="top-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="top-header-content">
                            <a href="#"><i class="icon_phone"></i> <span>{{getConfig('contact.phone')}}</span></a>
                            <a href="#"><i class="icon_mail"></i> <span>{{getConfig('contact.email')}}</span></a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="top-header-content">
                            <!-- Top Social Area -->
                            <div class="top-social-area ml-auto">
                                <a href="{{getConfig('link_fb_group')}}" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="javascript::void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="javascript::void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="javascript::void(0)"><i class="fa fa-google" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Top Header Area End -->

        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="robertoNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="{{route('home.index')}}"><img src="{{url('images/logo/logo_black.png')}}" alt="" class="nav-logo"></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="active"><a href="{{route('home.index')}}">{{transa('home')}}</a></li>
                                    <li><a href="{{route('home.community')}}">{{transa('community')}}</a></li>
                                    <li><a href="{{route('frontend.feedbacks.create')}}">{{transa('contact')}}</a></li>
                                </ul>
                                <!-- Login -->
                                <div class="book-now-btn ml-3 ml-lg-5">
                                    @php $login = frontendGuard()->check() ? 'logout' : 'login'; @endphp
                                    <a href="{{route('frontend.'.$login)}}">{{transa($login)}} <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(css/img/slide1.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h4 data-animation="fadeInLeft" data-delay="200ms">Chào mừng</h4>
                                    <h2 data-animation="fadeInLeft" data-delay="500ms">Bạn đến với xemotchieu</h2>
                                    <a href="{{route('home.community')}}" class="btn roberto-btn btn-2" data-animation="fadeInLeft" data-delay="800ms">{{transa('discover')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(css/img/slide2.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h4 data-animation="fadeInLeft" data-delay="200ms">Chào mừng</h4>
                                    <h2 data-animation="fadeInLeft" data-delay="500ms">Bạn đến với xemotchieu</h2>
                                    <a href="{{route('home.community')}}" class="btn roberto-btn btn-2" data-animation="fadeInUp" data-delay="800ms">{{transa('discover')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url(css/img/slide3.jpg);">
                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                    <h4 data-animation="fadeInLeft" data-delay="200ms">Chào mừng</h4>
                                    <h2 data-animation="fadeInLeft" data-delay="500ms">Bạn đến với xemotchieu</h2>
                                    <a href="{{route('home.community')}}" class="btn roberto-btn btn-2" data-animation="fadeInDown" data-delay="800ms">{{transa('discover')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->

    <!-- About Us Area Start -->
    <section class="roberto-about-area section-padding-40-0">
        <div class="container mt-100">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <!-- Section Heading -->
                    <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                        <h6></h6>
                        <h2 style="text-transform: none;">Bài toán thực tế cho xemotchieu</h2>
                    </div>
                    <div class="about-us-content mb-100">
                        <h5 class="wow fadeInUp" data-wow-delay="300ms" style="text-align: justify;">Trang web chia sẻ thông tin và kết nối những chuyến xe đi một chiều. Mục đích của trang web được tạo ra là nhằm giải quyết những bài toán thực tế trong cuộc sống về những chuyến đi một chiều mà xe không có khách hoặc ít khách khi thực hiện chuyến đi, hay một người có thể tìm được chuyến đi phù hợp với những tuyến đi cố định của nhà xe.</h5>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-us-thumbnail mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <div class="row no-gutters">
                            <div class="col-12 text-center">
                                <div class="single-thumb">
                                    <img src="{{asset('css/img/wait_car.png')}}" alt="" style="width: 425px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <!-- About Us Area End -->

    <!-- Our Room Area Start -->
    <section class="roberto-rooms-area">
        <div class="rooms-slides owl-carousel">
            <!-- Single Room Slide -->
            <div class="single-room-slide d-flex align-items-center">
                <!-- Thumbnail -->
                <div class="room-thumbnail h-100 bg-img" style="background-image: url(css/img/car1.jpg);"></div>

                <!-- Content -->
                <div class="room-content">
                    <h2 data-animation="fadeInUp" data-delay="100ms">Chủ Xe</h2>
                    <ul class="room-feature room-feature-custom" data-animation="fadeInUp" data-delay="500ms">
                        <li><span><i class="fa fa-check"></i> Kiếm thêm thu nhập</span></li>
                        <li><span><i class="fa fa-check"></i> Đăng bài tìm khách một cách dễ dàng</span></li>
                        <li><span><i class="fa fa-check"></i> Tìm kiếm khách theo khu vực cụ thể</span></li>
                        <li><span><i class="fa fa-check"></i> Tìm kiếm khách theo loại xe</span></li>
                        <li><span><i class="fa fa-check"></i> Quản lý các chuyến đi của mình</span></li>
                        <li><span><i class="fa fa-check"></i> Quản lý xe của mình</span></li>
                    </ul>
                </div>
            </div>

            <!-- Single Room Slide -->
            <div class="single-room-slide d-flex align-items-center">
                <!-- Thumbnail -->
                <div class="room-thumbnail h-100 bg-img" style="background-image: url(css/img/car2.jpg);"></div>

                <!-- Content -->
                <div class="room-content">
                    <h2 data-animation="fadeInUp" data-delay="100ms">Hành Khách</h2>
                    <ul class="room-feature room-feature-custom" data-animation="fadeInUp" data-delay="500ms">
                        <li><span><i class="fa fa-check"></i> Tiết kiệm được một khoản tiền</li>
                        <li><span><i class="fa fa-check"></i> Đăng bài tìm xe một chiều một chiều dễ dàng</li>
                        <li><span><i class="fa fa-check"></i> Tìm kiếm xe theo khu vực cụ thể</li>
                        <li><span><i class="fa fa-check"></i> Tìm kiếm xe theo loại xe</li>
                        <li><span><i class="fa fa-check"></i> Quản lý bài đăng của mình</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Room Area End -->

    <!-- Testimonials Area Start -->
    <section class="roberto-testimonials-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="testimonial-thumbnail owl-carousel mb-100">
                        <img src="{{asset('css/img/benefit.png')}}" alt="">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2 style="text-transform: none;">Lợi ích từ xemotchieu</h2>
                    </div>
                    <!-- Testimonial Slide -->
                    <div class="testimonial-slides owl-carousel mb-100">

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-car"></i> &nbsp; <span style="color: #1cc3b2;">Cho chủ xe</span></h4>
                            </div>
                            <h6>Chủ xe sẽ kiếm thêm một khoản thu nhập nếu có khách đi cùng tuyến đường cho những chuyến đi một chiều không có hoặc ít khách.</h6>
                        </div>

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-users"></i> &nbsp; <span style="color: #1cc3b2;">Cho hành khách</span></h4>
                            </div>
                            <h6>Tìm được xe đi cùng chuyến với kinh phí thương lượng với chủ xe. Từ đó sẽ có chuyến đi phù hợp và tiết kiệm hơn.</h6>
                        </div>

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-share-alt"></i> &nbsp; <span style="color: #1cc3b2;">Cho xã hội</span></h4>
                            </div>
                            <h6>Đáp ứng nhu cầu của xã hội với những chuyến đi một chiều về hoặc đi mà không có khách, giảm đáng kể kinh phí đi lại cho cả chủ xe và hành khách.</h6>
                        </div>

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-hand-paper-o"></i> &nbsp; <span style="color: #1cc3b2;">Nói không với ép giá</span></h4>
                            </div>
                            <h6>Bạn hoàn toàn không phải lo lắng về việc bị ép giá. Mỗi chuyến đi do chính bạn quyết định về giá.</h6>
                        </div>

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-location-arrow"></i> &nbsp; <span style="color: #1cc3b2;">Thao tác đơn giản</span></h4>
                            </div>
                            <h6>Chỉ với vài thao tác đơn giản thì bạn có thể tìm được chuyến đi phù hợp cho riêng mình hay chủ xe có thể tìm khách cho chuyến đi về mà không có khách của mình.</h6>
                        </div>

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-list-alt"></i> &nbsp; <span style="color: #1cc3b2;">Lưu trữ lịch sử</span></h4>
                            </div>
                            <h6>Mọi thông tin liên quan đến bạn bao gồm thông tin về bạn, xe, các bài đăng đều được lưu trữ lại.</h6>
                        </div>

                        <!-- Single Testimonial Slide -->
                        <div class="single-testimonial-slide">
                            <div class="rating-title">
                                <h4 style="color: #f5b917;"><i class="fa fa-thumbs-o-up"></i> &nbsp; <span style="color: #1cc3b2;">Uy tín và an toàn</span></h4>
                            </div>
                            <h6>Tất cả chuyến đi một chiều đều có chính sách đảm bảo an toàn và công bằng với tất cả mọi người.</h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Area End -->

    <!-- Call To Action Area Start -->
    <section class="roberto-cta-area">
        <div class="container">
            <div class="cta-content bg-img bg-overlay jarallax" style="background-image: url({{asset('css/img/contact.jpg')}});">
                <div class="row align-items-center">
                    <div class="col-12 col-md-7">
                        <div class="cta-text mb-50">
                            <h2>Liên hệ với chúng tôi!</h2>
                            <h6>Viết email hoặc gọi điện đến số {{getConfig('contact.phone')}} nhằm giải đáp những thắc mắc của bạn để bạn có thể hiểu rõ chúng tôi hơn.</h6>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 text-right">
                        <a href="{{route('frontend.feedbacks.create')}}" class="btn roberto-btn mb-50">{{transa('contact')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Area End -->

    <!-- Partner Area Start -->
    <div class="partner-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="partner-logo-content d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="300ms">
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="{{url('images/favicon.png')}}" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="{{url('css/img/laravel.png')}}" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="{{url('css/img/vuejs.png')}}" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="{{url('css/img/php.png')}}" alt=""></a>
                        <!-- Single Partner Logo -->
                        <a href="#" class="partner-logo"><img src="{{url('css/img/mysql.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Area End -->

    <!-- Footer Area Start -->
    <footer class="footer-area section-padding-60-0">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row align-items-baseline justify-content-between">
                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                    	<!-- <div class="single-footer-widget"> -->
	                        <!-- Footer Logo -->
	                        <a href="{{route('home.index')}}"><img src="{{getConfig('favicon_frontend')}}" alt="logo" class="footer-logo footer-logo-index"></a>
                    	<!-- </div> -->
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
                            <a href="{{getConfig('link_fb_group')}}" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="javascript::void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="javascript::void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="javascript::void(0)"><i class="fa fa-google" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    <script src="{{asset('js/vendor/jquery.min.js')}}"></script>
    <!-- Popper -->
    <script src="{{asset('js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
    <!-- All Plugins -->
    <script src="{{asset('js/frontend/roberto.bundle.js')}}"></script>
    <!-- Active -->
    <script src="{{asset('js/frontend/active.js')}}"></script>
</body>

</html>