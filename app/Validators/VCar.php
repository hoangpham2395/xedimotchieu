<?php
namespace App\Validators;

use App\Validators\Base\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class VCar extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'car_name' => 'required|max:128',
            'car_type' => 'required',
            'car_image' => 'nullable|max:5000|mimes:jpeg,png,gif,jpg',
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'car_name' => 'required|max:128',
            'car_type' => 'required',
            'car_image' => 'nullable|max:5000|mimes:jpeg,png,gif,jpg',
        ]
    ];
}