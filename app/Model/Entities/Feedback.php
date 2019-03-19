<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Scopes\Base\BaseScope;

class Feedback extends Base 
{
	protected $table = 'feedbacks';
	protected $primaryKey = 'id';
	protected $fillable = ['email', 'feedback', 'del_flag'];
	protected $_alias = 'feedbacks';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }

    public function user() 
    {
    	return $this->belongsTo(User::class, 'email', 'email');
    }
}