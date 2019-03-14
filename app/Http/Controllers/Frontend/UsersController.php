<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Repositories\UserRepository;
use App\Model\Entities\User;
use App\Validators\VUser;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;
use Illuminate\Http\Request;

class UsersController extends FrontendController
{
	
	public function __construct(
		UserRepository $userRepository,
		VUser $userValidator,
		User $user
	)
	{
		$this->setRepository($userRepository);
		$this->setValidator($userValidator);
		$this->setAlias($user->getTable());
		parent::__construct();
	}

	public function edit($id) 
	{
		$params = $this->_prepareShow();
        $entity = $this->getRepository()->findById($id);

        // Check id
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check permission
        if (!$entity->isOwner()) {
        	return redirect()->route('home.index');
        }

        return view('frontend.' . $this->getAlias() . '.edit', compact('entity', 'params'));
	}

	public function update(Request $request, $id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check permission
        if (!$entity->isOwner()) {
        	return redirect()->route('home.index');
        }

        $data = $this->_filterData($request->all());

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
            return redirect()->route('frontend.' . $this->getAlias() . '.edit', ['id' => $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Update failed
        $this->_deleteFileInTmpIfExist();
        return redirect()->route('frontend.' . $this->getAlias() . '.edit', ['id' => $id])->withErrors(['update_failed' => getMessage('update_failed')]);
    }

    protected function _filterData($data) 
    {
    	$r = [];
    	if (empty($data)) {
    		return $r;
    	}

    	foreach ($data as $key => $value) {
    		if (empty($value)) {
    			continue;
    		}
    		$r[$key] = $value;
    	}
    	return $r;
    }
}