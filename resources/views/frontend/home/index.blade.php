@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h6 class="w3-opacity">{{transa('search')}}</h6>
					<p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p>
					<button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;Post</button> 
				</div>
			</div>
		</div>
	</div>
	
	@foreach ($entities as $entity)
		<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
			<img src="{{getAvatarDefault()}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
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
			<button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;Chat</button> 
			<button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>
		</div>
	@endforeach
@endsection