<?php 
namespace App\Validators\Base;

use \Prettus\Validator\LaravelValidator; 
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class BaseValidator
 * @package App\Validators\Base
 */
class BaseValidator extends LaravelValidator
{

    /**
     * @param $params
     * @return bool
     */
    public function validateCreate($params)
	{
		try {
            return $this->with($params)->passes(ValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
            //$e->getMessage();
        }
		
	}

    /**
     * @param $params
     * @param $id
     * @return bool
     */
    public function validateUpdate($params, $id)
	{
		try {
            return $this->with($params)->setId($id)->passes(ValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            //$e->getMessage();
        }
		
	}
}