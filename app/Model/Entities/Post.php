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

    public function user() 
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rates() 
    {
    	return $this->hasMany(Rate::class, 'post_id', 'id');
    }

    public function car() 
    {
    	return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function comments() 
    {
    	return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function cityForm() 
    {
    	return $this->belongsTo(City::class, 'city_from_id', 'id');
    }

    public function cityTo() 
    {
    	return $this->belongsTo(City::class, 'city_to_id', 'id');
    }

    public function districtForm() 
    {
    	return $this->belongsTo(District::class, 'district_from_id', 'id');
    }

    public function districtTo() 
    {
    	return $this->belongsTo(District::class, 'district_to_id', 'id');
    }
}