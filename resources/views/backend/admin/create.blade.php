@extends('layouts.backend.structure.main')
@section('content')
    @include('layouts.backend.breadcrumb', ['object' => 'admin', 'action' => 'create'])

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{!! transb('admin.create') !!}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                {!! Form::open(['route' => 'admin.store', 'method' => 'POST', 'files' => true]) !!}
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