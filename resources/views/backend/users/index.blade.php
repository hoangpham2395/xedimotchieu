@extends('layouts.backend.structure.main')
@section('content')
    <section class="content-header">
        <h1>
            {{transb('users.name')}}
            <small>{{transb('users.index')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Users</a></li>
            <li class="active">{{transb('users.index')}}</li>
        </ol>
    </section>

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
                        {!! Form::open(['route' => 'users.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', transm('users.name')) !!}
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        {!! Form::text('name', Request::input('name'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('email', transm('users.email')) !!}
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        {!! Form::text('email', Request::input('email'), ['class' => 'form-control']) !!}
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
                        <h3 class="box-title">{!! transb('users.index') !!}</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th width="50">{{transm('users.id')}}</th>
                                    <th>{{transm('users.name')}}</th>
                                    <th>{{transm('users.email')}}</th>
                                    <th>{{transm('users.fb_id')}}</th>
                                    <th>{{transm('users.gg_id')}}</th>
                                    <th>{{transm('users.open_flag')}}</th>
                                    <th width="50" class="text-center">{{ transa('delete') }}</th>
                                </thead>
                                <tbody>
                                @foreach ($entities as $entity)
                                    <tr class="item-{{ $entity->id }}">
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->name }}</td>
                                        <td>{{ $entity->email }}</td>
                                        <td>{{ $entity->fb_id }}</td>
                                        <td>{{ $entity->gg_id }}</td>
                                        <td class="text-center">{!! $entity->getOpenFlag() !!}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_del_{{$entity->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        {!! Form::open(['route' => ['users.destroy', $entity->id], 'method' => 'DELETE']) !!}
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