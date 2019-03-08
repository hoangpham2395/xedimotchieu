<?php
namespace App\Model\Entities;

use App\Model\Base\Base;
use App\Model\Presenters\PUser;
use App\Model\Scopes\Base\BaseScope;

class User extends Base
{
    use PUser;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'fb_id', 'gg_id', 'email', 'password','open_flag', 'del_flag'];
    protected $_alias = 'users';

    // Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }
}