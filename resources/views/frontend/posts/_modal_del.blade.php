{!! Form::open(['route' => ['frontend.posts.destroy', $id], 'method' => 'DELETE']) !!}
	<!-- Modal -->
	<div class="modal fade" id="modal_del_{{$id}}" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">{{transb('posts.destroy')}}</h4>
				</div>
				<div class="modal-body">
					{{getMessage('text_confirm_delete')}}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">{{transa('delete')}}</button>
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}