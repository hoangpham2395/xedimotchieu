<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Http\Request;

class RegisterController extends FrontendController
{
    public function getRegister()
    {
        return view('frontend.auth.register');
    }

    public function postRegister(Request $request)
    {

    }
}