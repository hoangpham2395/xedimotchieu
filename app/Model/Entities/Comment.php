<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class Comment extends Base 
{
	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'post_id', 'comment', 'del_flag'];
	protected $_alias = 'comments';

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