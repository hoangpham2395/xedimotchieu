@if (!empty($suggests->count()))	
	@foreach ($suggests as $suggest)
		<div class="w3-container w3-card w3-white w3-round w3-margin-custom padding-bottom"><br>
			<img src="{{$entity->user->getUrlImage()}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px; height: 60px;">
			<h4>{{$suggest->getPlace()}}</h4>
			<h6>{{$suggest->user->name}} ({{$suggest->phone}}) | <a href="{{$suggest->getUrlChat()}}">Chat</a> <a href="{{route('home.community.detail', $suggest->id)}}" style="float: right;">Chi tiết</a></h6>
		</div>
	@endforeach
@else
	<div class="w3-container w3-card w3-white w3-round w3-margin-custom padding-bottom"><br>
		<h4>Không có gợi ý nào</h4>
	</div>
@endif
	