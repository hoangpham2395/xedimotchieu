<span class="input-group-addon"><i class="fa fa-map"></i></span>
{!! Form::select(array_get($params, 'field'), array_get($params, 'listDistricts'), null, ['class' => 'form-control select-fake', 'placeholder' => 'Huyện/Quận đến']) !!}

<script>
	$(function() {
		$('.select-fake').select2();
        $('.model_schedule_list .new_model_schedule:last .select-fake').select2();
	});
</script>