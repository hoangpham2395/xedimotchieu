<?php
namespace App\Model\Entities;

use App\Model\Base\Base;

class District extends Base 
{
	protected $table = 'districts';
	protected $primaryKey = 'id';
	protected $fillable = ['city_id', 'district_name', 'del_flag'];
	protected $_alias = 'districts';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}