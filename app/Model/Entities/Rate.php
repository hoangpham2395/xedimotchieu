<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

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

    public function user() 
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post() 
    {
    	return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}