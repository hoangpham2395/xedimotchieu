@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('posts.create')}}</h4> 
				</div>
				<div class="w3-container w3-padding">
					@if (frontendGuard()->user()->isCarOwner() && empty(frontendGuard()->user()->cars->count()))
						<span class="color-red">Bạn chưa <a href="{{route('frontend.cars.create')}}">đăng ký xe</a> nào trong hệ thống hoặc bạn có thể chuyển sang vai trò là <a href="{{route('frontend.users.edit', ['id' => frontendGuard()->user()->id])}}">Hành khách</a>.</span>
					@else
						{!! Form::open(['route' => 'frontend.posts.store', 'method' => 'POST', 'files' => true]) !!}
							@include('frontend.posts._form')
						{!! Form::close() !!}
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection