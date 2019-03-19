<?php
namespace App\Model\Entities;

use App\Model\Base\BaseAuth;
use App\Model\Presenters\PUser;
use App\Model\Scopes\Base\BaseScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends BaseAuth
{
    use Notifiable;
    use PUser;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'user_type', 'fb_id', 'gg_id', 'email', 'password', 'avatar', 'open_flag', 'del_flag'];
    protected $_alias = 'users';

    // Add global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BaseScope());
    }

    // Not use remember_token
    public function save(array $options = array()) 
    {
        if(isset($this->remember_token)) {
            unset($this->remember_token);
        }
        return parent::save($options);
    }

    public function setPasswordAttribute($value) 
    {
        $this->attributes['password'] = Hash::make($value);
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
        return $this->hasMany(Feedback::class, 'email', 'email');
    }
}