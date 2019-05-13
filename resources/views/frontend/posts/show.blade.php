@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('posts.show')}}</h4> 
				</div>
				<div class="w3-container w3-padding">
					<div class="w3-rol">
						<a href="{{route('frontend.posts.index')}}" class="btn btn-sm btn-default" title="{{transa('list')}}"><i class="fa fa-list-ul"></i></a>
						<a href="{{route('frontend.posts.create')}}" class="btn btn-sm btn-success" title="{{transa('add')}}"><i class="fa fa-plus"></i></a>
						<a href="{{route('frontend.posts.edit', ['id' => $entity->id])}}" class="btn btn-sm btn-primary" title="{{transa('edit')}}"><i class="fa fa-pencil"></i></a>
						<a href="{{route('frontend.posts.schedules', ['id' => $entity->id])}}" class="btn btn-sm btn-warning" title="Lịch trình"><i class="fa fa-map"></i></a>
						<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_del_{{$entity->id}}" title="{{transa('delete')}}">
                            <i class="fa fa-trash"></i>
                        </button>
                        @include('frontend.posts._modal_del', ['id' => $entity->id])
					</div>
					<div class="w3-row">
						<div class="w3-col m4 padding-right">
							<img src="{{$entity->getUrlImage()}}" style="max-height: 290px;">
						</div>
						<div class="w3-col m8 padding-left">
							<p><span class="w3-opacity">{{transm('posts.place_from')}}:</span> {{$entity->getPlaceFrom()}}</p>
							<p><span class="w3-opacity">{{transm('posts.place_to')}}:</span> {{$entity->getPlaceTo()}}</p>
							@if (frontendGuard()->user()->isCarOwner())
								<p><span class="w3-opacity">{{transm('cars.car_name')}}:</span> {{$entity->getCarName()}}</p>
							@endif
							<p><span class="w3-opacity">{{transm('posts.car_id')}}:</span> {{$entity->getCarType()}}</p>
							<p><span class="w3-opacity">{{transm('posts.type')}}:</span> {{$entity->getPostType()}}</p>
							<p><span class="w3-opacity">{{transm('posts.seats')}}:</span> {{$entity->getSeats()}}</p>
							<p><span class="w3-opacity">{{transm('posts.date_start')}}:</span> {{$entity->getDateStart()}}</p>
							<p><span class="w3-opacity">{{transm('posts.cost')}}:</span> {{$entity->getCost()}}</p>
							<p><span class="w3-opacity">{{transm('posts.phone')}}:</span> {{$entity->phone}}</p>
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m12 padding-bottom">
							<p>
								<span class="w3-opacity">{{transm('posts.note')}}:</span><br>
								{!! nl2br($entity->note) !!}
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection