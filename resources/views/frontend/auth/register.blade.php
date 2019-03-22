@extends('layouts.frontend.structure.auth.main')
@section('content')
    <p class="login-box-msg">{{getMessage('register_title')}}</p>

    @include('layouts.frontend.errors')

    {!! Form::open(['route' => 'frontend.register.store', 'method' => 'POST']) !!}
    <div class="form-group has-feedback">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => transm('users.email')]) !!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        {!! Form::select('user_type', getConfig('user_type'), null, ['class' => 'form-control', 'placeholder' => transm('users.user_type') . ' ---']) !!}
    </div>
    <div class="form-group has-feedback">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => transm('users.password')]) !!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => transm('users.confirm_password')]) !!}
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="agree_term"> {!! getMessage('register_agree_term') !!}
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            {!! Form::submit(transa('register'), ['class' => 'btn btn-primary btn-block btn-flat']) !!}
        </div>
        <!-- /.col -->
    </div>
    {!! Form::close() !!}

    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="{{url('login/redirect/facebook')}}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> {{getMessage('login_fb')}}</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="{{route('frontend.login')}}" class="text-center">{{getMessage('register_login')}}</a>
@endsection