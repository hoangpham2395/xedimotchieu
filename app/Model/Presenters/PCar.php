<?php
namespace App\Model\Presenters;

trait PCar 
{
	public function getCarType() 
	{
		return getConfig('car_type.' . $this->car_type);
	}

	public function getUrlImage() 
	{
		return (!$this->car_image || !file_exists(public_path($this->car_image))) ? '' : asset($this->car_image);
	}

	public function getImage() 
	{
		if (empty($this->getUrlImage())) {
			return '';
		}
		return '<img src="'. $this->getUrlImage() .'" style="max-width: 200px"; max-height: 100px;">';
	}

	public function isOwner() 
	{
		if (!frontendGuard()->check()) {
    		return false;
    	}

    	return $this->user_id == frontendGuard()->user()->id;
	}
}