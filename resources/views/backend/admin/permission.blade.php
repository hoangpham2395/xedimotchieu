@extends('layouts.backend.structure.main')
@section('content')
	<section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">{{ transa('permission') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="color-red"><i class="fa fa-exclamation-triangle"></i> Bạn không có quyền để xem trang vừa rồi.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection