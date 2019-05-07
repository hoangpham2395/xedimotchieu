<!-- Left Column -->
<div class="w3-col m3">
	<!-- Profile -->
	<div class="w3-card w3-round w3-white">
		<div class="w3-container">
			<h4 class="w3-center">{{transb('users.my_profile')}}</h4>
			<p class="w3-center">
				<img src="{{frontendGuard()->user()->getUrlImage()}}" class="w3-circle" style="height:106px;width:106px" alt="Avatar">
			</p>
			<hr>
			<p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i> {{frontendGuard()->user()->name}}</p>
			<p><i class="fa fa-car fa-fw w3-margin-right w3-text-theme"></i> {{frontendGuard()->user()->getUserType()}}</p>
			<p><i class="fa fa-envelope-o fa-fw w3-margin-right w3-text-theme"></i> {{frontendGuard()->user()->email}}</p>
		</div>
	</div>
	<br>

	<!-- Accordion -->
	<div class="w3-card w3-round">
		<div class="w3-white">
			<a href="{{route('frontend.users.edit', ['id' => frontendGuard()->user()->id])}}" class="w3-button w3-block w3-theme-l1 w3-left-align">
				<i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> {{transb('users.profile_edit')}}
			</a>
			<button onclick="showSubMenu('left_col_posts')" class="w3-button w3-block w3-theme-l1 w3-left-align">
				<i class="fa fa-share fa-fw w3-margin-right"></i> {{transb('posts.management')}}
			</button>
			<div id="left_col_posts" class="w3-hide w3-container">
				<p><a href="{{route('frontend.posts.index')}}">{{transb('posts.index')}}</a></p>
				<p><a href="{{route('frontend.posts.create')}}">{{transb('posts.create')}}</a></p>
			</div>
			@if (frontendGuard()->user()->isCarOwner())
				<button onclick="showSubMenu('left_col_cars')" class="w3-button w3-block w3-theme-l1 w3-left-align">
					<i class="fa fa-car fa-fw w3-margin-right"></i> {{transb('cars.management')}}
				</button>
				<div id="left_col_cars" class="w3-hide w3-container">
					<p><a href="{{route('frontend.cars.index')}}">{{transb('cars.index')}}</a></p>
					<p><a href="{{route('frontend.cars.create')}}">{{transb('cars.create')}}</a></p>
				</div>
			@endif
			<a href="{{route('frontend.chat.index')}}" class="w3-button w3-block w3-theme-l1 w3-left-align">
				<i class="fa fa-commenting-o fa-fw w3-margin-right"></i> {{transb('chat.name')}}
			</a>
			<a href="{{route('frontend.feedbacks.create')}}" class="w3-button w3-block w3-theme-l1 w3-left-align">
				<i class="fa fa-pencil fa-fw w3-margin-right"></i> {{transb('feedbacks.create')}}
			</a>
		</div>      
	</div>
	<br>
</div>
<!-- End Left Column -->