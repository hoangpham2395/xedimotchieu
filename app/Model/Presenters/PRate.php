<?php
namespace App\Model\Presenters;

trait PRate 
{
	public function getTime() 
	{
		return $this->created_at;
	}
}