<!-- Modal -->
<div class="modal fade" id="modal_reply_{{$entity->id}}" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(['route' => 'feedbacks.reply', 'method' => 'POST']) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">{{transb('feedbacks.reply')}}</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label>{{transm('feedbacks.email')}}: </label>
				            <span>{{$entity->email}}</span>
				            <input type="hidden" name="email" value="{{$entity->email}}">
				        </div>
				    </div>
				</div>
				<div class="row">
				    <div class="col-md-12">
				        <div class="form-group">
				        	<label>{{transm('feedbacks.reply')}}: </label>
				        	<p><textarea class="form-control" rows="5" name="content" required></textarea></p>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">{{transa('close')}}</button>
				<button type="submit" class="btn btn-success">{{transa('send')}}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>