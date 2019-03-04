@include('layouts.backend.errors')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('username', getTitle('admin.username')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => getTitle('admin.username')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', getTitle('admin.email')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-open"></i></span>
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => getTitle('admin.email')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('role_type', getTitle('admin.role_type')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                {!! Form::select('role_type', $params['role_type'], null, ['class' => 'form-control', 'placeholder' => '--- Select role type ---']) !!}
            </div>
        </div>
    </div>
</div>
@if (!isset($entity))
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('password', getTitle('admin.password')) !!} <span class="required"></span>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => getTitle('admin.password')]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('confirm_password', getTitle('admin.confirm_password')) !!} <span class="required"></span>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => getTitle('admin.confirm_password')]) !!}
                </div>
            </div>
        </div>
    </div>
@endif
@include('layouts.backend.btn_form')