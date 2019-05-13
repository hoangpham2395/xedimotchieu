<span class="input-group-addon"><i class="fa fa-map"></i></span>
{!! Form::select(array_get($params, 'field'), array_get($params, 'listDistricts'), null, ['class' => 'form-control select2', 'required' => true, 'placeholder' => 'Huyện/Quận đến']) !!}

<script>
	$(function() {
		$('.select2').select2();
	});
</script>