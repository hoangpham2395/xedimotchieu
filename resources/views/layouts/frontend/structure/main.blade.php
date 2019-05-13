<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{{getConstant('APP_NAME')}}</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('images/favicon.png') }}">
	@stack('tag_header')
	@include('layouts.frontend.load.css')
  	@yield('css')
</head>
<body class="w3-theme-l5">
	<!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

	@include('layouts.frontend.structure.navbar')
	
	<!-- Main content -->
	<div class="w3-container w3-content" style="max-width:1400px; margin-top:110px">    
  		<!-- The Grid -->
  		<div class="w3-row {{ empty(frontendGuard()->user()) ? 'center' : '' }}">
  			@if (!empty(frontendGuard()->user()))
				@include('layouts.frontend.structure.left_column')
			@endif
			<div class="w3-col m9">
				@yield('content')
			</div>
		</div>
	</div>
	<br>
	<!-- Footer -->
	@include('layouts.frontend.structure.footer')
	@include('layouts.frontend.load.js')
	@yield('javascript')
	@stack('scripts')
</body>
</html>