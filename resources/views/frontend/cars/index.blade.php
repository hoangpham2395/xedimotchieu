@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('cars.index')}}</h4> 
				</div>
				@include('layouts.frontend.notify')
				<div class="w3-container w3-padding">
					<div class="row">
                        <div class="col-md-12 text-right padding-bottom">
                            <a href="{{route('frontend.cars.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{transb('cars.create')}}</a>
                        </div>
                    </div>
					@if (!empty($entities) && $entities->total() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <th>{{transm('cars.id')}}</th>
                                <th>{{transm('cars.car_name')}}</th>
                                <th>{{transm('cars.car_type')}}</th>
                                <th>{{transm('cars.car_image')}}</th>
                                <th width="80" class="text-center">{{transa('edit')}}</th>
                                <th width="80" class="text-center">{{transa('delete')}}</th>
                                </thead>
                                <tbody>
                                @foreach ($entities as $entity)
                                    <tr>
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->car_name }}</td>
                                        <td>{{ $entity->getCarType() }}</td>
                                        <td class="text-center">{!! $entity->getImage() !!}</td>
                                        <td class="text-center">
                                            <a href="{{route('frontend.cars.edit', $entity->id)}}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modal_del_{{$entity->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        @include('frontend.cars._modal_del', ['id' => $entity->id])
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">Hiển thị {{ count($entities) }} trên {{ $entities->total() }} xe.</div>
                            <div class="col-sm-7">{{ $entities->links() }}</div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <span class="color-red"><i class="fa fa-exclamation-triangle"></i> Không có xe nào.</span>
                            </div>
                        </div>
                    @endif
                    <div class="padding-bottom"></div>
				</div>
			</div>
		</div>
	</div>
@endsection