@php 
	$idx = !empty($idx) ? $idx : 0; 
	$item = !empty($item) ? $item->toArray() : null;
	$id = !empty($item->id) ? $item->id : $idx;
@endphp

<div class="model_schedule_info w3-row-padding padding-top" data-id="{{$id}}">
	<div class="w3-col m12">
		<div class="w3-card w3-round w3-white">
			<div class="w3-container w3-padding">
				<h4 class="w3-opacity">Địa điểm <span class="panel_heading">{{(is_numeric($idx) ? $idx + 1 : $idx)}}</span></h4> 
			</div>
			<div class="w3-container w3-padding">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('city_from_id', transm('schedules.city_id')) !!} <span class="required"></span> 	
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-building"></i></span>
								{!! Form::select('city_id[]', array_get($params, 'listCities'), array_get($item, 'city_id'), ['class' => 'form-control select2 select-city', 'required' => true, 'placeholder' => transm('schedules.city_id'), 'data-action' => route('frontend.districts.get_districts_by_city'), 'data-token' => csrf_token(), 'data-id' => 'district_id_'. $id, 'data-field' => 'district_id[]', 'onchange' => 'PostsController.getDistricts(this);']) !!}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('district_id', transm('schedules.district_id')) !!} <span class="required"></span>
							<div class="input-group select-district" id="district_id_{{$id}}">
								<span class="input-group-addon"><i class="fa fa-map"></i></span>
								{!! Form::select('district_id[]', array_get($params, 'listDistricts'), array_get($item, 'district_id'), ['class' => 'form-control select2', 'required' => true, 'placeholder' => transm('schedules.district_id')]) !!}
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 bootstrap-timepicker">
						<div class="form-group">
							{!! Form::label('time', transm('schedules.time')) !!}	
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								{!! Form::text('time[]', array_get($item, 'time'), ['class' => 'form-control timepicker', 'placeholder' => transm('schedules.time')]) !!}
							</div>
						</div>
					</div>
					<div class="col-md-6 {{ !isMobile() ? 'btn-delete-schedule' : ''}}">
						<button class="btn btn-danger delete-row @if ($idx == 0) hide @endif" type="button" onclick="PostsController.removeSchedule(this)">
                        <span class="ls-icon ls-icon-remove" aria-hidden="true"></span> Xóa lịch trình
                    </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>