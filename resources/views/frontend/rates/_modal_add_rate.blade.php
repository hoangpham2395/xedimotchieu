{!! Form::open(['route' => 'frontend.rates.store', 'method' => 'POST', 'id' => 'formAddRate']) !!}
	{!! Form::hidden('post_id', $postId) !!}
	<!-- Modal -->
	<div class="modal fade" id="modal_add_rate" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">{{transb('rates.create')}}</h4>
				</div>
				<div class="modal-body">
					<div id="alert_rate" class="alert alert-danger alert-dismissable display-none">
				        <ul>
			                <li class="error-rate display-none">Bạn chưa đánh giá sao.</li>
			                <li class="error-comment display-none">Bạn chưa bình luận.</li>
				        </ul>
				    </div>
					<div class="row">
					    <div class="col-md-12">
					        <div class="form-group">
					            <input name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-show-clear="false" data-show-caption="false" required>
					        </div>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
					        <div class="form-group">
					            {!! Form::label('comment', transm('rates.comment')) !!} <span class="required"></span>
				                {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => transm('rates.comment'), 'required']) !!}
					        </div>
					    </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="RatesController.store('#formAddRate');" data-dismiss="modal">{{transa('confirm')}}</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{transa('cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}