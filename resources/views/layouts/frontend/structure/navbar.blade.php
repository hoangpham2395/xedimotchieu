<!-- Navbar -->
<div class="w3-top">
	<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
		<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
		<a href="{{route('home.index')}}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">
			<i class="fa fa-car w3-margin-right"></i> {{getConstant('APP_NAME')}}
		</a>
		
		<!-- Navbar right -->
		@php $login = !empty(frontendGuard()->user()) ? 'logout' : 'login'; @endphp
		<a href="{{route('frontend.'. $login)}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transa($login)}}">
			<!-- <i class="fa fa-sign-in"></i>  -->
			{{transa($login)}}
		</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transa('post')}}">
			<!-- <i class="fa fa-share"></i>  -->
			{{transa('post')}}
		</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transa('introduce')}}">
			<!-- <i class="fa fa-globe"></i>  -->
			{{transa('introduce')}}
		</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transa('search')}}">
			<!-- <i class="fa fa-search"></i>  -->
			{{transa('search')}}
		</a>
		
		<!-- <div class="w3-dropdown-hover w3-hide-small">
			<button class="w3-button w3-padding-large" title="Notifications">
				<i class="fa fa-bell"></i>
				<span class="w3-badge w3-right w3-small w3-green">3</span>
			</button>     
			<div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
				<a href="https://www.w3schools.com/w3css/tryw3css_templates_social.htm#" class="w3-bar-item w3-button">One new friend request</a>
				<a href="https://www.w3schools.com/w3css/tryw3css_templates_social.htm#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
				<a href="https://www.w3schools.com/w3css/tryw3css_templates_social.htm#" class="w3-bar-item w3-button">Jane likes your post</a>
			</div>
		</div> -->
	</div>

	<!-- Navbar on small screens -->
	<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
		<a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-large"></a>
		<a href="#" class="w3-bar-item w3-button w3-padding-large">{{transa('introduce')}}</a>
		<a href="#" class="w3-bar-item w3-button w3-padding-large">{{transa('post')}}</a>
		<a href="{{route('frontend.login')}}" class="w3-bar-item w3-button w3-padding-large">{{transa('login')}}</a>
	</div>
</div>