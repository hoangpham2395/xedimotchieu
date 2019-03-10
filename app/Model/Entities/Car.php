<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

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

    public function user() 
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posts() 
    {
    	return $this->hasMany(Post::class, 'car_id', 'id');
    }
}