@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4>{{transb('chat.index')}}</h4> 
				</div>
				<div id="app">
					<chat-app :user="{{ frontendGuard()->user() }}"></chat-app>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css')
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('javascript')
	<script src="{{ asset('js/app.js') }}"></script>
@endsection