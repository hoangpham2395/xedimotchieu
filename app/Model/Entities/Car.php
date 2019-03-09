<?php
namespace App\Model\Entities;

use App\Model\Base\Base;

class Car extends Base 
{
	protected $table = 'cars';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'car_name', 'car_type', 'car_image', 'del_flag'];
	protected $_alias = 'cars';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}