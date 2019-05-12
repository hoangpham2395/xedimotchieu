<?php
namespace App\Validators;

use App\Validators\Base\BaseValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class VPost extends BaseValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'city_from_id' => 'required',
        	'city_to_id' => 'required',
        	'district_from_id' => 'required',
        	'district_to_id' => 'required',
        	'type' => 'required',
            'seats' => 'required|numeric',
        	'date_start' => 'required',
        	'cost' => 'required|digits_between:0,10000000',
        	'phone' => 'required',
        	'image' => 'nullable|max:5000|mimes:jpeg,png,gif,jpg',
        	'note' => 'required',
        	'tags' => 'nullable|max:512'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'city_from_id' => 'required',
            'city_to_id' => 'required',
            'district_from_id' => 'required',
            'district_to_id' => 'required',
            'type' => 'required',
            'seats' => 'required|numeric',
            'date_start' => 'required',
            'cost' => 'required|numeric',
            'phone' => 'required',
            'image' => 'nullable|max:5000|mimes:jpeg,png,gif,jpg',
            'note' => 'required',
            'tags' => 'nullable|max:512'
        ]
    ];
}