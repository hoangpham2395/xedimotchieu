<?php 

namespace App\Repositories;

use App\Repositories\Base\CustomRepository;
use App\Model\Entities\Admin;
use App\Validators\VAdmin;

/**
 * 
 */
class AdminRepository extends CustomRepository
{
	function model() 
	{
		return Admin::class;
	}

	public function validator() 
	{
		return VAdmin::class;
	}
}