@extends('layouts.backend.structure.main')
@section('content')
	@include('layouts.backend.breadcrumb', ['object' => 'dashboard', 'action' => 'index'])

	<!-- Main content -->
    <section class="content">
    	<!-- Info boxes -->
      	<div class="row">
	      	<div class="col-md-3 col-sm-6 col-xs-12">
	      		<div class="info-box" data-toggle="tooltip" data-placement="bottom" title="{{getMessage('dashboard_users', ['users' => array_get($params, 'users'), 'car_owner' => array_get($params, 'car_owner'), 'passenger' => array_get($params, 'passenger')])}}">
	      			<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

	      			<div class="info-box-content">
	      				<span class="info-box-text">{{transb('users.name')}}</span>
	      				<span class="info-box-number">{{ array_get($params, 'users') }}</span>
	      			</div>
	      			<!-- /.info-box-content -->
	      		</div>
	      		<!-- /.info-box -->
	      	</div>
      		<!-- /.col -->
	      	<div class="col-md-3 col-sm-6 col-xs-12">
	      		<div class="info-box" data-toggle="tooltip" data-placement="bottom" title="{{getMessage('dashboard_posts', ['posts' => array_get($params, 'posts')])}}">
	      			<span class="info-box-icon bg-red"><i class="fa fa-comment"></i></span>

	      			<div class="info-box-content">
	      				<span class="info-box-text">{{transb('posts.name')}}</span>
	      				<span class="info-box-number">{{ array_get($params, 'posts') }}</span>
	      			</div>
	      			<!-- /.info-box-content -->
	      		</div>
	      		<!-- /.info-box -->
	      	</div>
	      	<!-- /.col -->

	      	<!-- fix for small devices only -->
	      	<div class="clearfix visible-sm-block"></div>

	      	<div class="col-md-3 col-sm-6 col-xs-12">
	      		<div class="info-box" data-toggle="tooltip" data-placement="bottom" title="{{getMessage('dashboard_cars', ['cars' => array_get($params, 'cars')])}}">
	      			<span class="info-box-icon bg-green"><i class="fa fa-car"></i></span>

	      			<div class="info-box-content">
	      				<span class="info-box-text">{{transb('cars.name')}}</span>
	      				<span class="info-box-number">{{ array_get($params, 'cars') }}</span>
	      			</div>
	      			<!-- /.info-box-content -->
	      		</div>
	      		<!-- /.info-box -->
	      	</div>
	      	<!-- /.col -->
	      	<div class="col-md-3 col-sm-6 col-xs-12">
	      		<div class="info-box" data-toggle="tooltip" data-placement="bottom" title="{{getMessage('dashboard_cities', ['cities' => array_get($params, 'cities')])}}">
	      			<span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-road"></i></span>

	      			<div class="info-box-content">
	      				<span class="info-box-text">{{transb('cities.name')}}</span>
	      				<span class="info-box-number">{{ array_get($params, 'cities') }}</span>
	      			</div>
	      			<!-- /.info-box-content -->
	      		</div>
	      		<!-- /.info-box -->
	      	</div>
	      	<!-- /.col -->
      	</div>
      	<!-- /.row -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">{{ transb('dashboard.report') }}</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body chart-responsive">
						<div class="chart" id="line-chart" style="height: 300px;"></div>
					</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
	<script>
        $(function () {
            "use strict";

            // LINE CHART
			var data = {!! json_encode(array_get($params, 'dataChart')) !!};

            var line = new Morris.Line({
                element: 'line-chart',
                resize: true,
                data: data,
                xkey: 'month',
                ykeys: ['user', 'post', 'car'],
                labels: ['Thành viên mới', 'Bài đăng', 'Số xe đăng ký mới'],
                lineColors: ['#00c0ef', '#dd4b39', '#00a65a'],
                hideHover: 'auto'
            });
        });
	</script>
@endsection