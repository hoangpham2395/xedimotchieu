<?php
namespace App\Model\Scopes\Base;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('del_flag', '=', getConstant('DEL_FLAG.ACTIVE'));
    }
}