<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\AdminRepository;
use App\Validators\VAdmin;
use App\Model\Entities\Admin;
use Illuminate\Http\Request;

/**
 * 
 */
class AdminController extends BackendController
{
	public function __construct(
		AdminRepository $adminRepository, 
		VAdmin $adminValidator, 
		Admin $admin) 
	{
		$this->setRepository($adminRepository);
		$this->setValidator($adminValidator);
		$this->setAlias($admin->getTable());
		parent::__construct();
	}

	protected function _prepareData()
    {
        $params['role_type'] = getConfig('role_type');
        $params = array_merge($params, parent::_prepareData());
        return $params;
    }
}