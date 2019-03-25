<div class="w3-container w3-card w3-white w3-round w3-margin w3-margin-custom">			
	<div class="row">
		<div class="col-sm-4">
			<div class="rating-block average-rating">
				<h4>{{getMessage('average_rating')}}</h4>
				<h2 class="bold padding-bottom-7">{{array_get($params, 'rates.average_rating')}} <small>/ 5</small></h2>
				<input name="input-2" class="rating rating-loading" value="{{array_get($params, 'rates.average_rating')}}" data-min="0" data-max="5" data-step="0.1" data-show-clear="false" data-show-caption="false" data-disabled="true" data-size="xl">
				</button>
			</div>
		</div>
		<div class="col-sm-6 col-xs-8 rating-breakdown">
			<h4>{{getMessage('rating_breakdown')}}</h4>
			@foreach (getConfig('rating_breakdown') as $key => $item)
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">{{$key}} <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-{{$item}}" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: {{array_get($params, 'rates.rating_breakdown.'. $key .'.per_cent')}}%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">{{array_get($params, 'rates.rating_breakdown.'. $key .'.count')}}</div>
				</div>
			@endforeach
		</div>
	</div>	
	<hr/>		
	
	@if (!empty($rates) && $rates->total() > 0)
		<div class="row">
			<div class="col-sm-12">
				<div class="review-block">
					@foreach ($rates as $rate)
					<div class="row">
						<div class="col-sm-3 col-xs-12">
							<img src="{{$rate->user->getUrlImage()}}" class="img-circle" style="width: 60px; height: 60px;">
							<div class="review-block-name"><a href="#">{{$rate->user->name}}</a></div>
						</div>
						<div class="col-sm-9 col-xs-12">
							<div class="review-block-rate">
								<input name="input-2" class="rating rating-loading" value="{{$rate->rate}}" data-min="0" data-max="5" data-step="0.1" data-show-clear="false" data-show-caption="false" data-disabled="true" data-size="sm">
							</div>
							<div class="review-block-time">{{$rate->getTime()}}</div>
							<div class="review-block-description">{!! nl2br($rate->comment) !!}</div>
						</div>
					</div>
					<hr/>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-sm-12 text-center">{{ $rates->links() }}</div>
        </div>
	@endif
</div>

<script src="{{asset('js/vendor/star-rating.min.js')}}"></script>