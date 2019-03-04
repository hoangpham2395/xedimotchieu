<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin() 
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        }
        return view('backend.auth.login');
    }

    public function postLogin(Request $request) 
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        $data = $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        // Check validate
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rememberMe = ($request->input('remember_me')) ? true : false;
        if (Auth::guard('web')->attempt($data, $rememberMe)) {
            return redirect()->route('dashboard');
        } 
        // Login Fail
        $errors = new MessageBag(['errorLogin' => 'Email or password is incorrect.']);
        return redirect()->back()->withErrors($errors)->withInput();
    }

    public function logout() 
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
