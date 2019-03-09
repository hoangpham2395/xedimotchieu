<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class Comment extends Base 
{
	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'post_id', 'comment', 'del_flag'];
	protected $_alias = 'comments';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}