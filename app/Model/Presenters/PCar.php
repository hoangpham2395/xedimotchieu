<?php
namespace App\Model\Presenters;

trait PCar 
{
	public function getCarType() 
	{
		return getConfig('car_type.' . $this->car_type);
	}
}