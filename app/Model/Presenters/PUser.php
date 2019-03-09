<?php
namespace App\Model\Presenters;

trait PUser
{
    public function getOpenFlag()
    {
        $openFlagActive = getConstant('OPEN_FLAG_ACTIVE');
        $class = ($this->open_flag == $openFlagActive) ? 'success' : 'basic';
        $text = ($this->open_flag == $openFlagActive) ? 'On' : 'Off';

    	return '<button type="button" class="btn btn-sm btn-'. $class .'" data-id="'. $this->id .'" data-open-flag="' . $this->open_flag . '" onclick="UsersController.changeOpenFlag(this)">'. $text .'</button>';
    }

    public function getUserType() 
    {
    	return getConfig('user_type.' . $this->user_type);
    }
}