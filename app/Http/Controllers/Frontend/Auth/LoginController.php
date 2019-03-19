<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends FrontendController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {

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
}