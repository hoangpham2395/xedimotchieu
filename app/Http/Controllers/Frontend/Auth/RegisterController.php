<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\VUser;
use App\Model\Entities\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Session;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Frontend\Auth
 */
class RegisterController extends FrontendController
{
    /**
     * RegisterController constructor.
     * @param UserRepository $userRepository
     * @param VUser $userValidator
     * @param User $user
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getRegister()
    {
        if (frontendGuard()->check()) {
            return redirect('/');
        }
        return view('frontend.auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(Request $request)
    {
    	$data = $request->all();

        // Validate
        $valid = $this->getValidator()->validateCreate($data);
        if (!$valid) {
            return redirect()->back()->withErrors($this->getValidator()->errors())->withInput();
        }

        // Check term of service
        if (empty(array_get($data, 'agree_term'))) {
        	return redirect()->back()->withErrors(new MessageBag(['errorNotAgreeTerm' => getMessage('error_not_agree_term')]))->withInput();
        }

        // Create
        $data['name'] = 'User' . $this->getNextId();

        DB::beginTransaction();
        try {
            $this->getRepository()->create($data);
            DB::commit();

            Session::flash('success', getMessage('create_account_success'));
            return redirect()->route('frontend.login');
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Create failed
        return redirect()->back()->withErrors(['create_failed' => getMessage('create_failed')]);
    }
}