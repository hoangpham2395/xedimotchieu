<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!!getConstant('APP_NAME')!!}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('layouts.frontend.load.css')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('home.index')}}">{{getConstant('APP_NAME')}}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @yield('content')
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@include('layouts.frontend.load.js')

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>