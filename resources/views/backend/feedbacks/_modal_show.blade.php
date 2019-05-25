<!-- Modal -->
<div class="modal fade" id="modal_show_{{$entity->id}}" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">{{transb('feedbacks.show')}}</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				    <div class="col-md-12">
				        <div class="form-group">
				            <label>{{transm('feedbacks.email')}}: </label>
				            <span>{{$entity->email}}</span>
				        </div>
				    </div>
				</div>
				<div class="row">
				    <div class="col-md-12">
				        <div class="form-group">
				        	<label>{{transm('feedbacks.content')}}: </label>
				        	<p>{!! ebr($entity->content) !!}</p>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">{{transa('close')}}</button>
			</div>
		</div>
	</div>
</div>