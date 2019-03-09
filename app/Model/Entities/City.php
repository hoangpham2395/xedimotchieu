<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class City extends Base 
{
	protected $table = 'cities';
	protected $primaryKey = 'id';
	protected $fillable = ['city_name', 'del_flag'];
	protected $_alias = 'cities';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}