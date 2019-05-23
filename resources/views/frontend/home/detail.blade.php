@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-container w3-card w3-white w3-round w3-margin-custom"><br>
		<img src="{{$entity->user->getUrlImage()}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px; height: 60px;">
		<h4>{{$entity->getPlace()}}</h4>
		<h6>{{$entity->user->name}}</h6>
		@if(isMobile())
			@include('frontend.home._btn_fb_share')
		@endif
		<br>
		<hr class="w3-clear">
		<div class="w3-row-padding">
			<div class="w3-col m4">
				<p>
					<span class="w3-opacity">{{transm('posts.type')}}:</span> {{$entity->getPostType()}}
				</p>
				<p>
					<span class="w3-opacity">{{transm('posts.car_type')}}:</span> {{$entity->getCarType()}}
				</p>
				<p>
					<span class="w3-opacity">{{transm('posts.seats')}}:</span> {{$entity->getSeats()}}
				</p>
				<p>
					<span class="w3-opacity">{{transm('posts.date_start')}}:</span> {{$entity->getDateStart()}}
				</p>
				<p>
					<span class="w3-opacity">{{transm('posts.cost')}}:</span> {{$entity->getCost()}}
				</p>
				<p>
					<span class="w3-opacity">{{transm('posts.phone')}}:</span> {{$entity->phone}}
				</p>
			</div>
			<div class="w3-col m8">
				<p>{!! nl2br($entity->note) !!}</p>
				{!! $entity->showImage() !!}
			</div>
		</div>
		<a href="{{$entity->getUrlChat()}}" target="blank" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-commenting-o"></i> &nbsp;{{transa('chat')}}</a> 
		@if ($allowRate)
			<button type="button" class="w3-button w3-theme-d2 w3-margin-bottom" data-toggle="modal" data-target="#modal_add_rate">
				<i class="fa fa-thumbs-up"></i> &nbsp;{{transa('rate')}}
			</button>
		@endif
		<a href="{{route('home.community.suggest', $entity->id)}}" class="w3-button w3-theme-d2 w3-margin-bottom">
			<i class="fa fa-lightbulb-o"></i> {{transa('suggest')}}
		</a>
		@if(!isMobile())
			@include('frontend.home._btn_fb_share')
		@endif
	</div>

	@if ($isSuggest)
		@include('frontend.home._suggest', ['suggests' => $suggests])
	@endif 

	<div id="list_rates">
		@include('frontend.rates._list_rates')
	</div>
	@if (frontendGuard()->check())
		@include('frontend.rates._modal_add_rate', ['postId' => $entity->id, 'params' => $params])
	@else
		@include('frontend.rates._modal_check_login', ['postId' => $entity->id])
	@endif
@endsection

@push('tag_header')
	<meta name="description" content="Cộng đồng chia sẻ thông tin những chuyến đi một chiều" />
	<meta name="keywords" content="Xe một chiều" />
	<meta property="og:site_name" content="Xe một chiều" />
	<meta property="og:type" content="article" />
	<meta property="og:locale" content="vi_VN" />
	<meta property="fb:app_id" content="{{env('FACEBOOK_APP_ID')}}" />
	<meta property="fb:pages" content="{{env('FACEBOOK_APP_SECRET')}}" />
	<meta property="og:title" itemprop="name" content="Cộng đồng xe một chiều" />
	<meta property="og:url" itemprop="url" content="{{route('home.community.detail', $entity->id)}}" />
	<meta property="og:description" content="Cộng đồng chia sẻ thông tin những chuyến đi một chiều" />
	<meta property="og:image" content="{{$entity->images}}" itemprop="thumbnailUrl" />
@endpush