<?php
namespace App\Validators;

use App\Validators\Base\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class VFeedback extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'email' => 'required|max:128',
            'content' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'email' => 'required|max:128',
            'content' => 'required',
        ]
    ];
}