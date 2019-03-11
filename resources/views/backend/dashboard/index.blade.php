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
						<h3 class="box-title">{{ transb('dashboard.name') }}</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body chart-responsive">
						<div class="chart" id="revenue-chart" style="height: 300px;"></div>
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

            // AREA CHART
            var area = new Morris.Area({
                element: 'revenue-chart',
                resize: true,
                data: [
                    {y: '2011 Q1', item1: 2666, item2: 2666},
                    {y: '2011 Q2', item1: 2778, item2: 2294},
                    {y: '2011 Q3', item1: 4912, item2: 1969},
                    {y: '2011 Q4', item1: 3767, item2: 3597},
                    {y: '2012 Q1', item1: 6810, item2: 1914},
                    {y: '2012 Q2', item1: 5670, item2: 4293},
                    {y: '2012 Q3', item1: 4820, item2: 3795},
                    {y: '2012 Q4', item1: 15073, item2: 5967},
                    {y: '2013 Q1', item1: 10687, item2: 4460},
                    {y: '2013 Q2', item1: 8432, item2: 5713}
                ],
                xkey: 'y',
                ykeys: ['item1', 'item2'],
                labels: ['Item 1', 'Item 2'],
                lineColors: ['#a0d0e0', '#3c8dbc'],
                hideHover: 'auto'
            });
        });
	</script>
@endsection