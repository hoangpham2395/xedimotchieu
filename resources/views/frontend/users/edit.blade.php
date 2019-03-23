@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('users.profile_edit')}}</h4> 
				</div>
				@include('layouts.frontend.notify')
				<div class="w3-container w3-padding">
					<div class="w3-row">
						{!! Form::model($entity, ['route' => ['frontend.users.update', $entity->id], 'method' => 'PATCH', 'files' => true]) !!}
							<div class="w3-col m4">
								@include('layouts.frontend.upload_image', ['image' => 'avatar'])
							</div>
							<div class="w3-col m8">
								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group">
	                                        {!! Form::label('name', transm('users.name')) !!}
	                                        <span class="required"></span>
	                                    </div>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => transm('users.name')]) !!}
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group">
	                                        {!! Form::label('user_type', transm('users.user_type')) !!}
	                                        <span class="required"></span>
	                                    </div>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
	                                        {!! Form::select('user_type', getConfig('user_type'), null, ['class' => 'form-control']) !!}
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col-md-12">
	                            		<div class="form-group">
	                            			{!! Form::label('email', transm('users.email')) !!}
	                            			<span class="required"></span>
	                            		</div>
	                            		<div class="input-group">
	                            			<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => transm('users.email')]) !!}
	                            		</div>
	                            	</div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group">
	                                        {!! Form::label('password', transm('users.password')) !!}
	                                    </div>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
	                                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => transm('users.password')]) !!}
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group">
	                                        {!! Form::label('confirm_password', transm('users.confirm_password')) !!}
	                                    </div>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
	                                        {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => transm('users.confirm_password')]) !!}
	                                    </div>
	                                </div>
	                            </div>
                            	@if ($entity->showBtnFb())
	                            	<div class="row margin-top">
		                            	<div class="col-md-6">
		                            		<a href="/login/redirect/facebook" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sử dụng tài khoản Facebook</a>
		                            	</div>
	                            	</div>
                            	@endif
	                            <div class="row" style="margin-top: 15px; margin-bottom: 15px;">
	                            	<div class="col-md-12">
	                            		<button type="submit" class="w3-button w3-theme"><i class="fa fa-pencil"></i> &nbsp;{{transa('edit')}}</button>
	                            	</div>
	                            </div>
							</div> 
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection