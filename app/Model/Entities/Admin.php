<?php 

namespace App\Model\Entities;

use Illuminate\Notifications\Notifiable;
use App\Model\Scopes\Base\BaseScope;
use Illuminate\Support\Facades\Hash;
use App\Model\Base\BaseAuth;
use App\Model\Presenters\PAdmin;


/**
 * Class Admin
 * @package App\Model\Entities
 */
class Admin extends BaseAuth
{
	use Notifiable;
	use PAdmin;

	protected $table = 'admin';
	protected $primaryKey = 'id';
	protected $fillable = ['username', 'email', 'password', 'role_type', 'del_flag'];
	protected $_alias = 'admin';

	// Add global scope
	protected static function boot() 
	{
		parent::boot();
		static::addGlobalScope(new BaseScope);
	}

	public function setPasswordAttribute($value) 
	{
		$this->attributes['password'] = Hash::make($value);
	}
}