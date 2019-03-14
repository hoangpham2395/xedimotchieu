@include('layouts.frontend.errors')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('city_from_id', transm('posts.city_from_id')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                {!! Form::select('city_from_id', array_get($params, 'listCities'), null, ['class' => 'form-control select2', 'placeholder' => transm('posts.city_from_id')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('district_from_id', transm('posts.district_from_id')) !!} <span class="required"></span>
            <div class="input-group">
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
                {!! Form::select('city_to_id', array_get($params, 'listCities'), null, ['class' => 'form-control select2', 'placeholder' => transm('posts.city_to_id')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('district_to_id', transm('posts.district_to_id')) !!} <span class="required"></span>
            <div class="input-group">
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
                {!! Form::text('cost', null, ['class' => 'form-control', 'placeholder' => transm('posts.cost')]) !!}
                <span class="input-group-addon">VND</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', transm('posts.phone')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => transm('posts.phone')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('image', transm('posts.image')) !!} <br>
            <span class="color-red">Ảnh sẽ hiển thị ở cuối bài đăng.</span>
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
            <span class="color-red">Ngăn cách giữa các thẻ là dấu phẩy. VD: facebook,google, ...</span>
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