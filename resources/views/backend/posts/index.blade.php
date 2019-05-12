@extends('layouts.backend.structure.main')
@section('content')
	@include('layouts.backend.breadcrumb', ['object' => 'posts', 'action' => 'index'])
	<!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{{ transa('search') }}</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route' => 'posts.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{transm('posts.user_id')}}</label>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        {!! Form::text('username', Request::input('username'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{transm('posts.date_start')}}</label>
                                    </div>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {!! Form::text('date_start', Request::get('date_start'), ['class' => 'form-control pull-right datetimepicker', 'placeholder' => transm('posts.date_start')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="margin-top"></div>
                            @include('layouts.backend.btn_search')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
	<section class="content">
		<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{{ transb('posts.index') }}</h3>
                    </div>
                    <div class="box-body">
                    	@if (!empty($entities) && $entities->total() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
	                                    <th width="50">{{transm('posts.id')}}</th>
	                                    <th width="300">{{transm('posts.user_id')}}</th>
	                                    <th>{{transm('posts.note')}}</th>
                                        <th>{{transm('posts.date_start')}}</th>
                                        <th width="80" class="text-center">{{transa('delete')}}</th>
                                    </thead>
                                    <tbody>
	                                    @foreach ($entities as $entity)
	                                        <tr>
	                                            <td>{{ $entity->id }}</td>
	                                            <td>{{ $entity->getUsername() }}</td>
	                                            <td style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    {!! nl2br($entity->note) !!}
                                                </td>
                                                <td>{{ $entity->date_start }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                                data-target="#modal_del_{{$entity->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>  
                                                </td> 
                                                {!! Form::open(['route' => ['posts.destroy', $entity->id], 'method' => 'DELETE']) !!}
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal_del_{{$entity->id}}" tabindex="-1" role="dialog"
                                                     aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel">Delete</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
	                                        </tr>
	                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('layouts.backend.pagination', ['object' => 'bài đăng'])
                        @else
                            @include('layouts.backend.no_result', ['object' => 'bài đăng'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
	</section>
@endsection