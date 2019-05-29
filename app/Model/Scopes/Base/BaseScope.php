<?php
namespace App\Model\Scopes\Base;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BaseScope
 * @package App\Model\Scopes\Base
 */
class BaseScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
    	$table = $model->getTable();
    	$delFlag = !empty($table) ? $table. '.del_flag' : 'del_flag';
        $builder->where($delFlag, '=', getConstant('DEL_FLAG.ACTIVE'));
    }
}