@extends('layouts.backend.structure.main')
@section('content')
    <section class="content-header">
        <h1>
            Users
            <small>{!! transb('users.index') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Users</a></li>
            <li class="active">{!! transb('users.index') !!}</li>
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
                                <th width="50">{{getTitle('users.id')}}</th>
                                <th>{{getTitle('users.name')}}</th>
                                <th>{{getTitle('user.email')}}</th>
                                <th>{{getTitle('users.fb_id')}}</th>
                                <th>{{getTitle('users.gg_id')}}</th>
                                <th>{{getTitle('users.open_flag')}}</th>
                                <th width="50" class="text-center">Edit</th>
                                <th width="50" class="text-center">Delete</th>
                                </thead>
                                <tbody>
                                @foreach ($entities as $entity)
                                    <tr>
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->name }}</td>
                                        <td>{{ $entity->email }}</td>
                                        <td>{{ $entity->fb_id }}</td>
                                        <td>{{ $entity->gg_id }}</td>
                                        <td>{{ $entity->gg_id }}</td>
                                        <td>{{ $entity->getOpenFlag() }}</td>
                                        <td class="text-center">
                                            <a href="{{route('admin.edit', $entity->id)}}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
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