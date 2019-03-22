<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends FrontendController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->setRepository($userRepository);
        parent::__construct();
    }

    public function getLogin()
    {
        if (frontendGuard()->check()) {
            return redirect('/');
        }
        return view('frontend.auth.login');
    }

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
            if (!empty($request->input('return_url'))) {
                return redirect($request->get('return_url'));
            }
            return redirect()->route('frontend.users.edit', ['id' => frontendGuard()->user()->id]);
        }
        // Login Fail
        $errors = new MessageBag(['errorLogin' => getMessage('error_login')]);
        return redirect()->back()->withErrors($errors)->withInput();
    }

    public function logout()
    {
        Auth::guard('frontend')->logout();
        return redirect()->route('home.index');
    }

    public function redirect($social) 
    {
        try {
            if(!empty(Input::get('return_url'))) {
                Session::put('is_frontend_login', true);
            }
            return Socialite::driver($social)->redirect();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['not_connect_fb' => getMessage('not_connect_fb')]);
        }
    }

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

            if (frontendGuard()->check()) {
                // Tài khoản đã login, muốn liên kết với facebook
                $user = frontendGuard()->user();
            } else {
                // Trường hợp đăng nhập, đăng ký với fb
                $user = $this->getRepository()->findByFb(array_get($data, 'fb_id'));
            }

            DB::beginTransaction();

            // Don't have account -> register
            if(!$user) {
                // Login
                if (Session::has('is_frontend_login')) {
                    Session::forget('is_frontend_login');
                    return redirect()->route('frontend.login')->withErrors(['not_have_account' => getMessage('not_have_account')]);
                }

                // Register
                try {
                    $data['user_type'] = getConfig('user_type_passenger');
                    $this->getRepository()->create($data);
                    DB::commit();
                    Session::flash('success', getMessage('create_account_success'));
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->route('frontend.register')->withErrors(['error_system' => getMessage('system_error')]);
                }
            }

            // Had account -> update name, email
            try {
                $this->getRepository()->update($data, $user->id);
                DB::commit();
            } catch(\Exception $e) {
                DB::rollback();
            }

            // Tài khoản đã login, muốn liên kết với facebook
            if (frontendGuard()->check()) {
                Session::flash('success', getMessage('update_success'));
                return redirect()->back();
            }

            // Check open flag
            if ($user->open_flag == getConstant('OPEN_FLAG_ACTIVE')) {
                frontendGuard()->loginUsingId($user->id);
                return redirect()->route('frontend.users.edit', ['id' => $user->id]);
            }

            return redirect()->back()->withErrors(['account_block' => getMessage('account_block')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['not_connect_fb' => getMessage('not_connect_fb')]);
        }
    }
}