@extends('layouts.backend.structure.main')
@section('content')
	@include('layouts.backend.breadcrumb', ['object' => 'feedbacks', 'action' => 'index'])

    @include('layouts.backend.notify')

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
	                                    <th width="300">{{transm('feedbacks.email')}}</th>
	                                    <th>{{transm('feedbacks.content')}}</th>
                                        <th width="80" class="text-center">{{transa('show')}}</th>
                                        <th width="80" class="text-center">{{transa('reply')}}</th>
                                    </thead>
                                    <tbody>
	                                    @foreach ($entities as $entity)
	                                        <tr>
	                                            <td>{{ $entity->id }}</td>
	                                            <td>{{ $entity->email }}</td>
	                                            <td style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    {!! ebr($entity->content) !!}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_show_{{$entity->id}}"><i class="fa fa-info-circle"></i></button>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal_reply_{{$entity->id}}"><i class="fa fa-share"></i></button>
                                                </td>
                                                @include('backend.feedbacks._modal_show')
                                                @include('backend.feedbacks._modal_reply')
	                                        </tr>
	                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('layouts.backend.pagination', ['object' => 'phản hồi'])
                        @else
                            @include('layouts.backend.no_result', ['object' => 'phản hồi'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
	</section>
@endsection