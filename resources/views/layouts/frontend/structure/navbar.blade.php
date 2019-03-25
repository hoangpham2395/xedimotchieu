<header class="header-area" style="position: fixed; top: 0; left: 0;">
    <!-- Top Header Area Start -->
    <!-- <div class="top-header-area">
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
                        Top Social Area
                        <div class="top-social-area ml-auto">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
    <!-- Top Header Area End -->

    <!-- Main Header Start -->
    <div class="main-header-area" style="background: #0e2737;">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="robertoNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="{{route('home.index')}}"><img src="{{url(getConfig('logo_frontend'))}}" alt="" class="nav-logo"></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler navbarToggler-white"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Menu Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav classynav-custom">
                            <ul id="nav">
                                <li><a href="{{route('home.index')}}">{{transa('home')}}</a></li>
                                <li><a href="{{route('home.community')}}">{{transa('community')}}</a></li>
                                <li><a href="{{route('frontend.posts.create')}}">{{transa('post')}}</a></li>
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