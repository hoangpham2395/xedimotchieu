<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

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

    public function city() 
    {
    	return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function postFrom() 
    {
    	return $this->hasMany(Post::class, 'district_form_id', 'id');
    }

    public function postTo() 
    {
    	return $this->hasMany(Post::class, 'district_to_id', 'id');
    }
}