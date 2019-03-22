@extends('layouts.frontend.structure.auth.main')
@section('content')
    <p class="login-box-msg">{{getMessage('login_title')}}</p>

    @include('layouts.frontend.errors')
    @include('layouts.frontend.success')

    {!! Form::open(['route' => 'frontend.login', 'method' => 'POST']) !!}
        <div class="form-group has-feedback">
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => transm('users.email')]) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => transm('users.password')]) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember_me"> {{getMessage('login_remember_me')}}
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                {!! Form::submit(transa('login'), ['class' => 'btn btn-primary btn-block btn-flat']) !!}
            </div>
            <!-- /.col -->
        </div>
        {!! Form::hidden('return_url', Request::get('return_url')) !!}
    {!! Form::close() !!}

    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="/login/redirect/facebook?return_url={{route('frontend.login')}}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> {{getMessage('login_fb')}}</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="{{route('frontend.forgot_password')}}">{{getMessage('login_forgot_password')}}</a><br>
    <a href="{{route('frontend.register')}}" class="text-center">{{getMessage('login_register')}}</a>
@endsection