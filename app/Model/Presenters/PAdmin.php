<?php
namespace App\Model\Presenters;

/**
 * Trait PAdmin
 * @package App\Model\Presenters
 */
trait PAdmin
{
	public function getRoleType() 
	{
		return getConfig('role_type.' . $this->role_type);
	}

	public function isSuperAdmin() 
	{
		return $this->id == getConfig('super_admin_type');
	}

	public function isOwner() 
	{
		return $this->id == getCurrentAdminId();
	}

	public function allowEdit() 
	{
		return getCurrentAdmin()->isSuperAdmin() || $this->isOwner();
	}

	public function allowDelete() 
	{
		return getCurrentAdmin()->isSuperAdmin() && !$this->isOwner();
	}
}