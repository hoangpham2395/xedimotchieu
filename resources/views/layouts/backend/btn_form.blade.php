<div class="row">
    <div class="col-sm-6">
        <a href="{{route($params['alias'] . '.index')}}" class="btn btn-default pull-right"><i class="fa fa-reply"></i> Back</a>
    </div>
    <div class="col-sm-6">
        {!! Form::button('<i class="fa fa-check"></i> Confirm', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
    </div>
</div>