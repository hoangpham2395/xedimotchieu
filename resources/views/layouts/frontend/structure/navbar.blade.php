<!-- Navbar -->
<div class="w3-top w3-top-custom">
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
		<a href="{{route('frontend.posts.create')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transb('posts.create')}}">
			<!-- <i class="fa fa-pencil"></i>  -->
			{{transb('posts.create')}}
		</a>
		<a href="{{route('home.community')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transa('community')}}">
			<!-- <i class="fa fa-globe"></i>  -->
			{{transa('community')}}
		</a>
		<a href="{{route('home.index')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="{{transa('home')}}">
			<!-- <i class="fa fa-home"></i>  -->
			{{transa('home')}}
		</a>
	</div>

	<!-- Navbar on small screens -->
	<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
		<a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-large"></a>
		<a href="{{route('home.index')}}" class="w3-bar-item w3-button w3-padding-large">
			<i class="fa fa-home"></i> &nbsp;{{transa('home')}}
		</a>
		<a href="{{route('home.community')}}" class="w3-bar-item w3-button w3-padding-large">
			<i class="fa fa-globe"></i> &nbsp;{{transa('community')}}
		</a>
		<a href="{{route('frontend.posts.create')}}" class="w3-bar-item w3-button w3-padding-large">
			<i class="fa fa-pencil"></i> &nbsp;{{transb('posts.create')}}
		</a>
		<a href="{{route('frontend.' . $login)}}" class="w3-bar-item w3-button w3-padding-large">
			<i class="fa fa-sign-in"></i> &nbsp;{{transa($login)}}
		</a>
	</div>
</div>