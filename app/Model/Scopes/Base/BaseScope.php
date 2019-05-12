<?php
namespace App\Model\Scopes\Base;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
    	$table = $model->getTable();
    	$delFlag = !empty($table) ? $table. '.del_flag' : 'del_flag';
        $builder->where($delFlag, '=', getConstant('DEL_FLAG.ACTIVE'));
    }
}