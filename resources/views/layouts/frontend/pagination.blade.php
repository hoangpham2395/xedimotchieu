<div class="row">
	@php 
		$object = !empty($object) ? $object : 'phần tử';
	@endphp
	<div class="col-sm-5">Hiển thị {{ count($entities) }} trên {{ $entities->total() . ' ' . $object}} .</div>
	<div class="col-sm-7">{{ $entities->appends(Request::except('page'))->render() }}</div>
</div>