<div class="row">
	<div class="col-md-12">
		@php 
			$object = !empty($object) ? $object : 'phần tử';
		@endphp
		<span class="color-red"><i class="fa fa-exclamation-triangle"></i> Không có {{ $object }} nào.</span>
	</div>
</div>