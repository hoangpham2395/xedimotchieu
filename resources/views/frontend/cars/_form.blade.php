@include('layouts.frontend.errors')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('car_name', transm('cars.car_name')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-car"></i></span>
                {!! Form::text('car_name', null, ['class' => 'form-control', 'placeholder' => transm('cars.car_name')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('car_type', transm('cars.car_type')) !!} <span class="required"></span>
            <div class="input-group" id="district_from_id">
                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                {!! Form::select('car_type', getConfig('car_type'), null, ['class' => 'form-control select2', 'placeholder' => getConfig('select_default')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('car_image', transm('cars.car_image')) !!} <br>
            @include('layouts.frontend.upload_image', ['image' => 'car_image'])
        </div>
    </div>
</div>
@include('layouts.frontend.btn_form')