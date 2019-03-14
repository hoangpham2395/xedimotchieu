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
					<p><a href="#">{{transb('cars.index')}}</a></p>
					<p><a href="#">{{transb('cars.create')}}</a></p>
				</div>
			@endif
			<a href="#" class="w3-button w3-block w3-theme-l1 w3-left-align">
				<i class="fa fa-commenting-o fa-fw w3-margin-right"></i> {{transb('feedbacks.create')}}
			</a>
		</div>      
	</div>
	<br>

	<!-- Interests --> 
	<div class="w3-card w3-round w3-white w3-hide-small">
		<div class="w3-container">
			<p>Interests</p>
			<p>
				<span class="w3-tag w3-small w3-theme-d5">News</span>
				<span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
				<span class="w3-tag w3-small w3-theme-d3">Labels</span>
				<span class="w3-tag w3-small w3-theme-d2">Games</span>
				<span class="w3-tag w3-small w3-theme-d1">Friends</span>
				<span class="w3-tag w3-small w3-theme">Games</span>
				<span class="w3-tag w3-small w3-theme-l1">Friends</span>
				<span class="w3-tag w3-small w3-theme-l2">Food</span>
				<span class="w3-tag w3-small w3-theme-l3">Design</span>
				<span class="w3-tag w3-small w3-theme-l4">Art</span>
				<span class="w3-tag w3-small w3-theme-l5">Photos</span>
			</p>
		</div>
	</div>
	<br>

	<!-- Alert Box -->
	<div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
		<span onclick="this.parentElement.style.display=&#39;none&#39;" class="w3-button w3-theme-l3 w3-display-topright">
			<i class="fa fa-remove"></i>
		</span>
		<p><strong>Hey!</strong></p>
		<p>People are looking at your profile. Find out who.</p>
	</div>
</div>
<!-- End Left Column -->