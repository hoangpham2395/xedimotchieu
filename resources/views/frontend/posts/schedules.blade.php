@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('posts.schedules')}}</h4> 
				</div>
				<div class="w3-container w3-padding" style="margin-top: -15px;">
					{!! Form::open(['route' => 'frontend.posts.post_schedules', 'method' => 'POST', 'files' => true]) !!}
						@php $schedules = $entity->schedules; $params['field'] = 'district_id[]'; @endphp

						<div class="model_schedule_list">
							@foreach($schedules as $idx => $schedule)
								@include('frontend.posts._schedule', ['idx' => $idx, 'item' => $schedule])
							@endforeach

							@if (empty($schedules->count()))
								@include('frontend.posts._schedule', ['idx' => 0])
							@endif
						</div>

						<div class="row {{ !isMobile() ? 'padding' : 'padding-top padding-bottom'}}">
						    <div class="col-sm-6 col-xs-6">
						        <button type="button" class="btn btn-primary" onclick="PostsController.addSchedule(this)">
						        	<i class="fa fa-plus"></i> Thêm lịch trình
						        </button>
						    </div>
						</div>
	
						<input type="hidden" name="post_id" value="{{array_get($params, 'post_id')}}">
						@include('layouts.frontend.btn_form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<script id="model_schedule_template" class="hidden" type="text/plain">
		@include('frontend.posts._schedule', ['idx' => '_prefix'])
	</script>
@endsection