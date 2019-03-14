<?php
namespace App\Validators;

use App\Validators\Base\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class VUser extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [
        	'name' => 'required|max:128',
        	'user_type' => 'required',
        	'email' => 'required|email|max:128|unique:users,email, :id',
        	'password' => 'nullable|max:64|min:6',
        	'confirm_password' => 'bail|nullable|required_with:password|same:password|max:64|min:6',
        	'avatar' => 'nullable|max:512|mimes:jpeg,png,gif,jpg',
        ]
    ];
}