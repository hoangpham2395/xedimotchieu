<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;

/**
 * Class LoginController
 * @package App\Http\Controllers\Frontend\Auth
 */
class LoginController extends FrontendController
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * LoginController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->setRepository($userRepository);
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getLogin()
    {
        if (frontendGuard()->check()) {
            return redirect('/');
        }
        return view('frontend.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        // Check validate 
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rememberMe = ($request->input('remember_me')) ? true : false;
        if (Auth::guard('frontend')->attempt($data, $rememberMe)) {
            // Check account is block
            if (frontendGuard()->user()->open_flag != getConstant('OPEN_FLAG_ACTIVE')) {
                frontendGuard()->logout();
                return redirect()->back()->withErrors(['account_block' => getMessage('account_block')])->withInput();
            }

            if (!empty($request->input('return_url'))) {
                return redirect($request->get('return_url'));
            }
            return redirect()->route('frontend.users.edit', ['id' => frontendGuard()->user()->id]);
        }
        // Login Fail
        $errors = new MessageBag(['errorLogin' => getMessage('error_login')]);
        return redirect()->back()->withErrors($errors)->withInput();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('frontend')->logout();
        return redirect()->route('frontend.login');
    }

    /**
     * @param $social
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($social)
    {
        try {
            // Check register
            if(!empty(Input::get('return_url'))) {
                Session::put('is_frontend_register', Input::get('return_url'));
            }
            return Socialite::driver($social)->redirect();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['not_connect_fb' => getMessage('not_connect_fb')]);
        }
    }

    /**
     * @param $social
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback($social)
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();

            $data = [
                'fb_id' => $socialUser->getID(),
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'avatar' => $socialUser->getAvatar()  
            ];

            DB::beginTransaction();

            // Register
            if (Session::has('is_frontend_register')) {
                Session::forget('is_frontend_register');
                if ($this->_checkValidate($data)) {
                    try {
                        $data['user_type'] = getConfig('user_type_passenger');
                        $this->getRepository()->create($data);
                        DB::commit();
                        Session::flash('success', getMessage('create_account_success'));
                        return redirect()->route('frontend.login');
                    } catch (\Exception $e) {
                        DB::rollback();
                        return redirect()->route('frontend.register')->withErrors(['error_system' => getMessage('system_error')]);
                    }
                }
                return redirect()->route('frontend.register')->withErrors(['error_register' => getMessage('error_register')]);
            }

            if (frontendGuard()->check()) {
                // Tài khoản đã login, muốn liên kết với facebook
                $user = frontendGuard()->user();
            } else {
                // Trường hợp đăng nhập, đăng ký với fb
                $user = $this->getRepository()->findByFb(array_get($data, 'fb_id'));
            }

            // Don't have account
            if(!$user) {
                return redirect()->route('frontend.login')->withErrors(['not_have_account' => getMessage('not_have_account')]);        
            }

            // Had account -> update name, email
            if ($this->_checkValidate($data, $user->id)) {
                try {
                    $this->getRepository()->update($data, $user->id);
                    DB::commit();

                    // Tài khoản đã login, muốn liên kết với facebook
                    if (frontendGuard()->check()) {
                        Session::flash('success', getMessage('update_success'));
                        return redirect()->back();
                    }
                } catch(\Exception $e) {
                    DB::rollback();
                }
            }

            if (frontendGuard()->check()) {
                return redirect()->route('frontend.users.edit', ['id' => $user->id])->withErrors(['error_system' => getMessage('error_register')])->withInput();
            }

            // Check open flag
            if ($user->open_flag == getConstant('OPEN_FLAG_ACTIVE')) {
                frontendGuard()->loginUsingId($user->id);
                return redirect()->route('frontend.users.edit', ['id' => $user->id]);
            }

            return redirect()->back()->withErrors(['account_block' => getMessage('account_block')]);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['not_connect_fb' => getMessage('not_connect_fb')]);
        }
    }

    /**
     * @param $data
     * @param null $id
     * @return bool
     */
    protected function _checkValidate($data, $id = null)
    {
        $rules = [
            'name' => 'required',
            'email' => 'nullable|email|max:128|unique:users,email',
            'fb_id' => 'required|unique:users,fb_id',
        ];

        if (!empty($id)) {
            $rules['email'] = $rules['email'] . ',' . $id;
            $rules['fb_id'] = $rules['fb_id'] . ',' . $id;
        }

        // Check validate 
        $validator = Validator::make($data, $rules);
        return $validator->fails() ? false : true;    
    }
}