<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Presenters\PSchedule;
use App\Model\Scopes\Base\BaseScope;

class Schedule extends Base 
{
	protected $table = 'schedules';
	protected $primaryKey = 'id';
	protected $fillable = ['post_id', 'city_id', 'district_id', 'time', 'del_flag'];
	protected $_alias = 'schedules';

	use PSchedule;

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }

    public function post() 
    {
    	return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function city() 
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district() 
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}