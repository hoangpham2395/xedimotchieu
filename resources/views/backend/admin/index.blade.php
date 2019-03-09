@extends('layouts.backend.structure.main')
@section('content')
	@include('layouts.backend.breadcrumb', ['object' => 'admin', 'action' => 'index'])

    @include('layouts.backend.notify')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{{ transa('search') }}</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route' => 'admin.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('email', transm('admin.email')) !!}
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        {!! Form::text('email', Request::input('email'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('role_type', transm('admin.role_type')) !!}
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        {!! Form::select('role_type', $params['role_type'], Request::input('role_type'), ['class' => 'form-control', 'placeholder' => '--- Select role type ---']) !!}
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
                        <h3 class="box-title">{!! transb('admin.index') !!}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 text-right padding-bottom">
                                <a href="{{route('admin.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{transb('admin.create')}}</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <th width="50">{{transm('admin.id')}}</th>
                                <th>{{transm('admin.username')}}</th>
                                <th>{{transm('admin.email')}}</th>
                                <th>{{transm('admin.role_type')}}</th>
                                <th width="50" class="text-center">{{transa('edit')}}</th>
                                <th width="50" class="text-center">{{transa('delete')}}</th>
                                </thead>
                                <tbody>
                                @foreach ($entities as $entity)
                                    <tr>
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->username }}</td>
                                        <td>{{ $entity->email }}</td>
                                        <td>{{ $entity->getRoleType() }}</td>
                                        <td class="text-center">
                                            @if ($entity->allowEdit())
	                                            <a href="{{route('admin.edit', $entity->id)}}" class="btn btn-sm btn-primary">
	                                                <i class="fa fa-pencil"></i>
	                                            </a>
                                            @endif
                                        </td>
                                        @if ($entity->allowDelete())
                                            <td class="text-center">
	                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
	                                                    data-target="#modal_del_{{$entity->id}}">
	                                                <i class="fa fa-trash"></i>
	                                            </button>
	                                        </td>
                                            {!! Form::open(['route' => ['admin.destroy', $entity->id], 'method' => 'DELETE']) !!}
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
                                        @else
                                            <td></td>
                                        @endif
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">Showing 1 to 10 of 10 entities</div>
                            <div class="col-sm-7">{{ $entities->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection