<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class Schedule extends Base 
{
	protected $table = 'schedules';
	protected $primaryKey = 'id';
	protected $fillable = ['post_id', 'address', 'time', 'del_flag'];
	protected $_alias = 'schedules';

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
}