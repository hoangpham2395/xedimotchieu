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
 * Class AdminController
 * @package App\Http\Controllers\Backend
 */
class AdminController extends BackendController
{
    /**
     * AdminController constructor.
     * @param AdminRepository $adminRepository
     * @param VAdmin $adminValidator
     * @param Admin $admin
     */
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

    /**
     * @return array|mixed
     */
    protected function _prepareData()
    {
        $params['role_type'] = getConfig('role_type');
        $params = array_merge($params, parent::_prepareData());
        return $params;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        // Check permission
        if (!$this->_checkPermission()) {
            return $this->_redirectToIndex();
        }

        return parent::index();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
    	// Check permission
    	if (!$this->_checkPermission()) {
    		return $this->_redirectToIndex();
    	}

    	return parent::create();
    }

    /**
     * @param Request $request
     * @return BackendController|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
    	// Check permission
    	if (!$this->_checkPermission()) {
    		return $this->_redirectToIndex();
    	}

    	return parent::store($request);
    }

    /**
     * @param $id
     * @return BackendController|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * @param Request $request
     * @param $id
     * @return BackendController|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param $id
     * @return BackendController|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * @return mixed
     */
    protected function _checkPermission()
    {
    	return getCurrentAdmin()->isSuperAdmin();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function _redirectToIndex()
    {
    	return redirect()->route('admin.permission')->withErrors(['permission' => getMessage('permission')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permission()
    {
        return view('backend.admin.permission');
    }
}