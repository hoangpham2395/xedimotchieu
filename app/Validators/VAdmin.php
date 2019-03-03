<?php 
namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\Base\BaseValidator;

class VAdmin extends BaseValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'email'  => 'required|email|unique:admin,email',
            'password'=> 'required|min:6|max:8',
            'confirm_password' => 'required_with:password|same:password|min:6|max:8',
            'role_type' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'email'  => 'required|email|unique:admin,email, :id',
            'role_type' => 'required',
        ]
   ];
}