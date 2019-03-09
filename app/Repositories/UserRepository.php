<?php
namespace App\Repositories;

use App\Model\Entities\User;
use App\Repositories\Base\CustomRepository;

class UserRepository extends CustomRepository
{
    public function model()
    {
        return User::class;
    }

    public function getCount() 
    {
    	$users = $this->all();
    	$carOwner = 0;
    	foreach ($users as $user) {
    		if ($user->isCarOwner()) {
    			$carOwner ++;
    		}
    	}

    	return [
    		'users' => count($users),
    		'car_owner' => $carOwner,
    		'passenger' => count($users) - $carOwner,
    	];
    }
}