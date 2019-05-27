<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\AdminRepository;
use App\Validators\VAdmin;
use App\Model\Entities\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;

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

    public function index() 
    {
        // Check permission
        if (!$this->_checkPermission()) {
            return $this->_redirectToIndex();
        }

        return parent::index();
    }

    public function create() 
    {
    	// Check permission
    	if (!$this->_checkPermission()) {
    		return $this->_redirectToIndex();
    	}

    	return parent::create();
    }

    public function store(Request $request) 
    {
    	// Check permission
    	if (!$this->_checkPermission()) {
    		return $this->_redirectToIndex();
    	}

    	return parent::store($request);
    }

    public function edit($id) 
    {
    	$params = $this->_prepareEdit();
        $entity = $this->getRepository()->findById($id);

        // Check id
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check permission
        if (!$this->_checkPermission() && !$entity->isOwner()) {
        	return $this->_redirectToIndex();
        }

        return view('backend.' . $this->getAlias() . '.edit', compact(['entity', 'params']));
    }

    public function update(Request $request, $id) 
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check permission
        if (!$this->_checkPermission() && !$entity->isOwner()) {
        	return $this->_redirectToIndex();
        }

        return parent::update($request, $id);
    }

    public function destroy($id) 
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check permission
        if (!$this->_checkPermission() || $entity->isOwner()) {
        	return $this->_redirectToIndex();
        }

        return parent::destroy($id);
    }

    protected function _checkPermission() 
    {
    	return getCurrentAdmin()->isSuperAdmin();
    }

    protected function _redirectToIndex() 
    {
    	return redirect()->route('admin.permission')->withErrors(['permission' => getMessage('permission')]);
    }

    public function permission() 
    {
        return view('backend.admin.permission');
    }
}