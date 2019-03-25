@extends('layouts.frontend.structure.main')
@section('content')
	
	<button type="button" class="btn-fixed btn-search" onclick="HomeController.search(this)" title="{{transa('search')}}">
		<i class="fa fa-search"></i>
	</button>
	<button type="button" class="btn-fixed btn-scroll" id="btn_scroll" onclick="HomeController.scrollToTop(0)" title="{{transa('scroll_to_top')}}">
		<i class="fa fa-chevron-up"></i>
	</button>
			
	<div class="w3-row-padding home-search {{array_get($params, 'display_search')}}" id="home_search">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 style="font-weight: bold;">{{getMessage('home_search')}}</h4>
					@include('frontend.home._search')
				</div>
			</div>
		</div>
	</div>

	<div class="w3-row-padding padding-top margin-bottom home-result {{array_get($params, 'display_search')}}">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 style="font-weight: bold;">{{getMessage('home_search_result', ['result' => $entities->total()])}}</h4>
				</div>
			</div>
		</div>
	</div>
	
	@foreach ($entities as $entity)
		<div class="w3-container w3-card w3-white w3-round w3-margin-custom"><br>
			<img src="{{$entity->user->getUrlImage()}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px; height: 60px;">
			<h4>{{$entity->getPlace()}}</h4>
			<h6>{{$entity->user->name}}</h6>
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
			<button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-commenting-o"></i> &nbsp;{{transa('chat')}}</button> 
			<a href="{{route('home.community.detail', ['id' => $entity->id])}}" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;{{transa('rate')}}</a>
		</div>
	@endforeach

	@if (!empty($entities) && $entities->total() > 0)
		<div class="row">
            <div class="col-sm-12 text-center">{{ $entities->links() }}</div>
        </div>
	@endif
@endsection

@section('javascript')
	<script type="text/javascript">
		// Scroll to top
		window.onscroll = function() {
			HomeController.showBtnScroll();
		};
	</script>
@endsection