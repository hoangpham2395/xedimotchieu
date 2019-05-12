@extends('layouts.frontend.structure.main')
@section('content')
	<div class="w3-row-padding">
		<div class="w3-col m12">
			<div class="w3-card w3-round w3-white">
				<div class="w3-container w3-padding">
					<h4 class="w3-opacity">{{transb('posts.index')}}</h4> 
				</div>
				@include('layouts.frontend.notify')
				<div class="w3-container w3-padding">
					<div class="row">
                        <div class="col-md-12 text-right padding-bottom">
                            <a href="{{route('frontend.posts.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{transb('posts.create')}}</a>
                        </div>
                    </div>
					@if (!empty($entities) && $entities->total() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <th width="50">{{transm('posts.id')}}</th>
                                <th width="300">{{transm('posts.place_from')}}</th>
                                <th width="300">{{transm('posts.place_to')}}</th>
                                <th width="200">{{transm('posts.car_type')}}</th>
                                <th width="200">{{transm('posts.type')}}</th>
                                <th width="300">{{transm('posts.date_start')}}</th>
                                <th width="200">{{transm('posts.cost')}}</th>
                                <th width="200">{{transm('posts.phone')}}</th>
                                <!-- <th>{{transm('posts.note')}}</th> -->
                                <th width="80" class="text-center">{{transa('show')}}</th>
                                <th width="80" class="text-center">{{transa('edit')}}</th>
                                <th width="50" class="text-center">{{transa('delete')}}</th>
                                </thead>
                                <tbody>
                                @foreach ($entities as $entity)
                                    <tr>
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->getPlaceFrom() }}</td>
                                        <td>{{ $entity->getPlaceTo() }}</td>
                                        <td>{{ $entity->getCarType() }}</td>
                                        <td>{{ $entity->getPostType() }}</td>
                                        <td>{{ $entity->getDateStart() }}</td>
                                        <td>{{ $entity->getCost() }}</td>
                                        <td>{{ $entity->phone }}</td>
                                        <!-- <td>{{ $entity->note }}</td> -->
                                        <td class="text-center">
                                            <a href="{{route('frontend.posts.show', $entity->id)}}" class="btn btn-sm btn-default">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('frontend.posts.edit', $entity->id)}}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#modal_del_{{$entity->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        @include('frontend.posts._modal_del', ['id' => $entity->id])
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.frontend.pagination', ['object' => 'bài đăng'])
                    @else
                        @include('layouts.frontend.no_result', ['object' => 'bài đăng'])
                    @endif
				</div>
			</div>
		</div>
	</div>
@endsection