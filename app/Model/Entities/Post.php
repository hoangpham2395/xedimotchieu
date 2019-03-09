<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class Post extends Base 
{
	protected $table = 'posts';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'city_from_id', 'city_to_id', 'district_from_id', 'district_to_id', 'car_id', 'type', 
							'date_start', 'cost', 'phone', 'image', 'note', 'tags', 'del_flag'];
	protected $_alias = 'posts';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}