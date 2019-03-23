<?php
namespace App\Model\Presenters;

trait PUser
{
    public function getOpenFlag()
    {
        $openFlagActive = getConstant('OPEN_FLAG_ACTIVE');
        $class = ($this->open_flag == $openFlagActive) ? 'success' : 'basic';
        $text = ($this->open_flag == $openFlagActive) ? 'On' : 'Off';

    	return '<button type="button" class="btn btn-sm btn-'. $class .'" data-id="'. $this->id .'" data-action="' . 
        route('users.update_open_flag') . '" data-token="'. csrf_token() .'" onclick="UsersController.changeOpenFlag(this)">'. $text .'</button>';
    }

    public function getUserType() 
    {
    	return getConfig('user_type.' . $this->user_type);
    }

    public function isCarOwner() 
    {
        return $this->user_type == getConfig('user_type_car_owner');
    }

    public function isOpen() 
    {
        return $this->open_flag == getConstant('OPEN_FLAG_ACTIVE');
    }

    public function isOwner() 
    {
        return $this->id == frontendGuard()->user()->id;
    }

    public function getUrlImage() 
    {
        if ($this->avatar && isElementInString(getConfig('url_facebook_image'), $this->avatar)) {
            return $this->avatar;
        }

        return (!$this->avatar || !file_exists(public_path($this->avatar))) ? getAvatarDefault() : asset($this->avatar);
    }

    public function showBtnFb() 
    {
        return empty($this->fb_id);
    }
}