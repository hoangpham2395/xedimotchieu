<section class="content-header">
	<h1>
		{{transb($object . '.name')}}
		<small>{{transb($object . '.' . $action)}}</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-user"></i> {{transb($object . '.name')}}</a></li>
		<li class="active">{{transb($object . '.' . $action)}}</li>
	</ol>
</section>