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

        $data = $request->all();

        // Upload file to tmp folder if exist
        $this->_uploadToTmpIfExist($request);

        // Validate
        $valid = $this->getValidator()->validateUpdate($data, $id);
        if (!$valid) {
            return redirect()->back()->withErrors($this->getValidator()->errors())->withInput();
        }

        // Update
        $data = array_merge($data, $this->_prepareUpdate());
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            // Move file to medias if exist
            $this->_moveToMediasIfExist($data);
            DB::commit();
            Session::flash('success', getMessage('update_success'));
            return redirect()->route($this->getAlias() . '.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Update failed
        $this->_deleteFileInTmpIfExist();
        return redirect()->route($this->getAlias() . '.index')->withErrors(['update_failed' => getMessage('update_failed')]);
    }

    public function destroy($id) 
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

        // Delete
        $data['del_flag'] = getConstant('DEL_FLAG.DELETED', 1);
        $data['upd_id'] = 1;
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            //$this->_deleteFileIfExist();
            DB::commit();
            Session::flash('success', getMessage('delete_success'));
            return redirect()->route($this->getAlias() . '.index');
        } catch(\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Delete failed
        return redirect()->route($this->getAlias() . '.index')->withErrors(['delete_failed' => getMessage('delete_failed')]);
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