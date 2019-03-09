<?php
namespace App\Model\Entities;

use App\Model\Base\Base;

class Feedback extends Base 
{
	protected $table = 'feedbacks';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'feedback', 'del_flag'];
	protected $_alias = 'feedbacks';

	// Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}