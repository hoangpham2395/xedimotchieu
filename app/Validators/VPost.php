<?php
namespace App\Validators;

use App\Validators\Base\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class VPost extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [

        ]
    ];
}