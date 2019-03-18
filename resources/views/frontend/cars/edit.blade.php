@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('cars.edit')}}</h4> 
				</div>
				<div class="w3-container w3-padding">
					{!! Form::model($entity, ['route' => ['frontend.cars.update', $entity->id], 'method' => 'PATCH', 'files' => true]) !!}
						@include('frontend.cars._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection