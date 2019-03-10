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
    protected $fillable = ['name', 'user_type', 'fb_id', 'gg_id', 'email', 'password','open_flag', 'del_flag'];
    protected $_alias = 'users';

    // Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }

    public function cars() 
    {
        return $this->hasMany(Car::class, 'user_id', 'id');
    }

    public function posts() 
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function rates() 
    {
        return $this->hasMany(Rate::class, 'user_id', 'id');
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function feedbacks() 
    {
        return $this->hasMany(Feedback::class, 'user_id', 'id');
    }
}