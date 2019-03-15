@include('layouts.frontend.errors')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('city_from_id', transm('posts.city_from_id')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                {!! Form::select('city_from_id', array_get($params, 'listCities'), null, ['class' => 'form-control select2', 'placeholder' => transm('posts.city_from_id'), 'data-action' => route('frontend.districts.get_districts_by_city'), 'data-token' => csrf_token(), 'data-id' => 'district_from_id', 'onchange' => 'PostsController.getDistricts(this);']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('district_from_id', transm('posts.district_from_id')) !!} <span class="required"></span>
            <div class="input-group" id="district_from_id">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                {!! Form::select('district_from_id', array_get($params, 'listDistricts'), null, ['class' => 'form-control select2', 'placeholder' => transm('posts.district_from_id')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('city_to_id', transm('posts.city_to_id')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                {!! Form::select('city_to_id', array_get($params, 'listCities'), null, ['class' => 'form-control select2', 'placeholder' => transm('posts.city_to_id'), 'data-action' => route('frontend.districts.get_districts_by_city'), 'data-token' => csrf_token(), 'data-id' => 'district_to_id', 'onchange' => 'PostsController.getDistricts(this);']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('district_to_id', transm('posts.district_to_id')) !!} <span class="required"></span>
            <div class="input-group" id="district_to_id">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                {!! Form::select('district_to_id', array_get($params, 'listDistricts'), null, ['class' => 'form-control select2', 'placeholder' => transm('posts.district_to_id')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    	@if (!empty(frontendGuard()) && frontendGuard()->user()->isCarOwner())
	        <div class="form-group">
	            {!! Form::label('car_id', transm('posts.car_id')) !!}
	            <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-car"></i></span>
	                {!! Form::select('car_id', array_get($params, 'listCars'), null, ['class' => 'form-control select2']) !!}
	            </div>
	        </div>
        @else 
			<div class="form-group">
	            {!! Form::label('car_type', transm('posts.car_type')) !!}
	            <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-car"></i></span>
	                {!! Form::select('car_type', array_get($params, 'listCars'), null, ['class' => 'form-control select2']) !!}
	            </div>
	        </div>
        @endif
    </div>
</div>
<div class="row">
	<div class="col-md-6">
        <div class="form-group">
            {!! Form::label('type', transm('posts.type')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                {!! Form::select('type', getConfig('post_type'), null, ['class' => 'form-control', 'placeholder' => getConfig('select_default')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('date_start', transm('posts.date_start')) !!} <span class="required"></span>
            <div class="input-group date">
            	<div class="input-group-addon">
            		<i class="fa fa-calendar"></i>
            	</div>
            	{!! Form::text('date_start', null, ['class' => 'form-control pull-right datetimepicker', 'placeholder' => transm('posts.date_start')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cost', transm('posts.cost')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                {!! Form::input('number', 'cost', null, ['class' => 'form-control', 'placeholder' => transm('posts.cost'), 'min' => 0, 'max' => 10000000]) !!}
                <span class="input-group-addon">VND</span>
            </div>
            <span class="color-red">{{getMessage('note_posts.cost')}}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', transm('posts.phone')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => transm('posts.phone'), 'maxlength' => 11]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('image', transm('posts.image')) !!} <br>
            <span class="color-red">{{getMessage('note_posts.image')}}</span>
            @include('layouts.frontend.upload_image', ['image' => 'image'])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('tags', transm('posts.tags')) !!}
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags	"></i></span>
                {!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => transm('posts.tags')]) !!}
            </div>
            <span class="color-red">{{getMessage('note_posts.tags')}}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('note', transm('posts.note')) !!} <span class="required"></span>
            {!! Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => transm('posts.note')]) !!}
        </div>
    </div>
</div>
@include('layouts.frontend.btn_form')