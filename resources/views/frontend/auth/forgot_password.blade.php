@extends('layouts.frontend.structure.auth.main')
@section('content')
	<p class="login-box-msg">{{getMessage('forgot_password_title')}}</p>

    @include('layouts.frontend.errors')
    @include('layouts.frontend.success')

    {!! Form::open(['route' => 'frontend.post_forgot_password', 'method' => 'POST']) !!}
	    <div class="form-group has-feedback">
	        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => transm('users.email')]) !!}
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	    </div>
	    <div class="row">
	        <div class="col-xs-8"></div>
	        <div class="col-xs-4">
	            {!! Form::submit(transa('send'), ['class' => 'btn btn-primary btn-block btn-flat']) !!}
	        </div>
	    </div>
    {!! Form::close() !!}
@endsection 