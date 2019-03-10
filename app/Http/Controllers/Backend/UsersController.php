<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends BackendController
{
    public function __construct(
        UserRepository $userRepository,
        User $user)
    {
        $this->setRepository($userRepository);
        $this->setAlias($user->getTable());
        parent::__construct();
    }

    public function updateOpenFlag(Request $request) 
    {
    	$data = $request->all();
    	$id = array_get($data, 'id');

    	$user = $this->getRepository()->findById($id);
    	if (empty($user)) {

    	}

    	DB::beginTransaction();
    	try {
    		$newOpenFlag = $user->isOpen() ? getConstant('OPEN_FLAG_NO_ACTIVE') : getConstant('OPEN_FLAG_ACTIVE');
    		$user->open_flag = $newOpenFlag;
    		$user->save();
    		DB::commit();
    		return response()->json([
    			'status' => true,
    			'openFlag' => $newOpenFlag
    		]);
    	} catch (\Exception $e) {
    		DB::rollBack();
    	}

    	// Update fail
    	return response()->json([
    		'status' => false,
    	]);
    }
}