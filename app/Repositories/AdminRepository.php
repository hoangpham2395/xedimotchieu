<?php 

namespace App\Repositories;

use App\Repositories\Base\CustomRepository;
use App\Model\Entities\Admin;
use App\Validators\VAdmin;

/**
 * Class AdminRepository
 * @package App\Repositories
 */
class AdminRepository extends CustomRepository
{
    /**
     * @return string
     */
    function model()
	{
		return Admin::class;
	}

    /**
     * @return string|null
     */
    public function validator()
	{
		return VAdmin::class;
	}
}