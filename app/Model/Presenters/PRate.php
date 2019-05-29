<?php
namespace App\Model\Presenters;

/**
 * Trait PRate
 * @package App\Model\Presenters
 */
trait PRate
{
	public function getTime() 
	{
		return $this->created_at;
	}

	public function isOwner() 
	{
		if (!frontendGuard()->check()) {
    		return false;
    	}

    	return $this->user_id == frontendGuard()->user()->id;
	}
}