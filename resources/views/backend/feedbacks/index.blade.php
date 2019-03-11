@extends('layouts.backend.structure.main')
@section('content')
	@include('layouts.backend.breadcrumb', ['object' => 'feedbacks', 'action' => 'index'])
	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{{ transb('feedbacks.index') }}</h3>
                    </div>
                    <div class="box-body">
                    	@if (!empty($entities) && $entities->total() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
	                                    <th width="50">{{transm('feedbacks.id')}}</th>
	                                    <th>{{transm('feedbacks.user_id')}}</th>
	                                    <th>{{transm('feedbacks.content')}}</th>
                                    </thead>
                                    <tbody>
	                                    @foreach ($entities as $entity)
	                                        <tr>
	                                            <td>{{ $entity->id }}</td>
	                                            <td>{{ $entity->user->name }}</td>
	                                            <td>{!! $entity->content !!}</td>
	                                        </tr>
	                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">Hiển thị {{ count($entities) }} trên {{ $entities->total() }} phản hồi.</div>
                                <div class="col-sm-7">{{ $entities->links() }}</div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="color-red"><i class="fa fa-exclamation-triangle"></i> Không có phản hồi nào.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
	</section>
@endsection