<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class Chat extends Base 
{
	protected $table = 'chat';
	protected $primaryKey = 'id';
	protected $fillable = ['user_from_id', 'user_to_id', 'content', 'read', 'del_flag'];
	protected $_alias = 'chat';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'user_from_id');
    }
}