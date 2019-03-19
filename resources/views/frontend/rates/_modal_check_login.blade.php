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
				<span>{{getMessage('rates_require_login')}}</span>
			</div>
			<div class="modal-footer">
				<button type="button" data-url="{{route('frontend.login', ['return_url' => route('home.community.detail', ['id' => $postId])])}}" class="btn btn-primary" data-dismiss="modal" onclick="RatesController.redirectLogin(this);">{{transa('login')}}</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">{{transa('cancel')}}</button>
			</div>
		</div>
	</div>
</div>