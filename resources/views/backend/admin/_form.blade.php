@include('layouts.backend.errors')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('username', transm('admin.username')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => transm('admin.username')]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', transm('admin.email')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-open"></i></span>
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => transm('admin.email')]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('role_type', transm('admin.role_type')) !!} <span class="required"></span>
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
                {!! Form::label('password', transm('admin.password')) !!} <span class="required"></span>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => transm('admin.password')]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('confirm_password', transm('admin.confirm_password')) !!} <span class="required"></span>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => transm('admin.confirm_password')]) !!}
                </div>
            </div>
        </div>
    </div>
@endif
@include('layouts.backend.btn_form')