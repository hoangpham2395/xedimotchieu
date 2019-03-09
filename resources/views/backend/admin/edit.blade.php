@extends('layouts.backend.structure.main')
@section('content')
    @include('layouts.backend.breadcrumb', ['object' => 'admin', 'action' => 'edit'])

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{!! transb('admin.edit') !!}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                {!! Form::model($entity, ['route' => ['admin.update', $entity->id], 'method' => 'PATCH', 'files' => true]) !!}
                                    @include('backend.admin._form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection