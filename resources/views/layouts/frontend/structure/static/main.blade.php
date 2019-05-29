<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{{getConstant('APP_NAME')}}</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('images/favicon.png') }}">
  	@include('layouts.frontend.load.css')
</head>
<body class="w3-theme-l5">
	@include('layouts.frontend.structure.navbar')
	
	<!-- Main content -->
	<div class="w3-container w3-content" style="max-width:950px;margin-top:120px">
  		@yield('content')
	</div>
	<br>
	<!-- Footer -->
	@include('layouts.frontend.structure.footer')
	@include('layouts.frontend.load.js')
	@yield('javascript')
</body>
</html>