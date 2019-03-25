<div class="row padding-bottom">
    <div class="col-sm-6 col-xs-6">
        {!! Form::button('<i class="fa fa-check"></i> ' . transa('confirm'), ['type' => 'submit', 'class' => 'btn btn-success pull-right']) !!}
    </div>
    <div class="col-sm-6 col-xs-6">
        <a href="{{route('frontend.' . $params['alias'] . '.index')}}" class="btn btn-default"><i class="fa fa-reply"></i> Cancel</a>
    </div>
</div>