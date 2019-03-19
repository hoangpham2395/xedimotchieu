@include('layouts.frontend.errors')
@include('layouts.frontend.success')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('email', transm('feedbacks.email')) !!} <span class="required"></span>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                {!! Form::email('email', frontendGuard()->check() ? frontendGuard()->user()->email : '', ['class' => 'form-control', 'placeholder' => transm('feedbacks.email'), 'disabled' => frontendGuard()->check() ? true : false]) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('content', transm('feedbacks.content')) !!} <span class="required"></span>
            {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => transm('feedbacks.content')]) !!}
        </div>
    </div>
</div>
<div class="row padding-bottom">
    <div class="col-md-12">
        <button type="submit" class="w3-button w3-theme"><i class="fa fa-paper-plane"></i> &nbsp;{{transa('send')}}</button>
    </div>
</div>
