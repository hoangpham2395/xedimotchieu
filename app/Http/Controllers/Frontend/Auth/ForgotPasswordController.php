<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use App\Repositories\UserRepository;
use App\Model\Entities\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;
use Session;
use Illuminate\Support\Facades\DB;
use Mail;

/**
 * Class ForgotPasswordController
 * @package App\Http\Controllers\Frontend\Auth
 */
class ForgotPasswordController extends FrontendController
{
    /**
     * ForgotPasswordController constructor.
     * @param UserRepository $userRepository
     * @param User $user
     */
    public function __construct(
		UserRepository $userRepository,
		User $user
	) 
	{
		$this->setRepository($userRepository);
		$this->setAlias($user->getTable());
		parent::__construct();
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function forgotPassword()
	{
		if (frontendGuard()->check()) {
            return redirect('/');
        }
		return view('frontend.auth.forgot_password');
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postForgotPassword(Request $request)
	{
		$data = [
			'email' => $request->input('email'),
		];

		$rules = [
			'email' => 'required|email',
		];

		// Check validate
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->getRepository()->findWhere(['email' => array_get($data, 'email')])->first();
        if (empty($user)) {
        	return redirect()->back()->withErrors(new MessageBag(['account_not_exist' => getMessage('account_not_exist')]))->withInput();
        }

        $newPass = randomString(8);
        DB::beginTransaction();
        try {
        	$user->password = $newPass;
        	$user->save();
        	$data = $user->toArray();
        	$data['new_password'] = $newPass;
        	if ($this->_sendMail($data)) {
        		DB::commit();
        		Session::flash('success', getMessage('send_mail_success'));
        		return redirect()->route('frontend.login');
	        }
	        // Send mail failed
	        return redirect()->back()->withErrors(new MessageBag(['send_mail_fail' => getMessage('send_mail_fail')]))->withInput();        	
        } catch(\Exception $e) {
        	DB::rollBack();
        }

        return redirect()->back()->withErrors(new MessageBag(['update_failed' => getMessage('system_error')]))->withInput(); 
	}

    /**
     * @param $data
     * @return bool
     */
    protected function _sendMail($data)
	{
		try {
			Mail::send('frontend.auth.mail', $data, function($message) use ($data) {
	         	$message->to(array_get($data, 'email'), array_get($data, 'name'))->subject(transa('change_password'));
	         	$message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
	      	});

	      	return true;
		} catch(\Exception $e) {
			return false;
		}
	}
}