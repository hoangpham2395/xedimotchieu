<div class="row">
    <div class="col-sm-6">
        <a href="{{route($params['alias'] . '.index')}}" class="btn btn-default pull-right">
            <i class="fa fa-refresh"></i> Reset
        </a>
        </div>
    <div class="col-sm-6">
        {!! Form::button('<i class="fa fa-search"></i> Search', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>