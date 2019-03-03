<?php 
namespace App\Validators\Base;

use \Prettus\Validator\LaravelValidator; 
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\Exceptions\ValidatorException;

/**
 * 
 */
class BaseValidator extends LaravelValidator
{
	
	public function validateCreate($params) 
	{
		try {
            return $this->with($params)->passes(ValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
            //$e->getMessage();
        }
		
	}

	public function validateUpdate($params, $id) 
	{
		try {
            return $this->with($params)->setId($id)->passes(ValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            //$e->getMessage();
        }
		
	}
}