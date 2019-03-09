<?php
namespace App\Model\Entities;

use App\Model\Base\Base;

class Rate extends Base 
{
	protected $table = 'rates';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'post_id', 'rate', 'del_flag'];
	protected $_alias = 'rates';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}