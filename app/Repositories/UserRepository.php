<?php
namespace App\Repositories;

use App\Model\Entities\User;
use App\Repositories\Base\CustomRepository;
use App\Validators\VUser;

class UserRepository extends CustomRepository
{
    public function model()
    {
        return User::class;
    }

    public function validator() 
    {
        return VUser::class;
    }

    public function getDataForDashboard()
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
            'dataChart' => $this->statisticalByMonthInYear(),
    	];
    }

    public function findByFb($fbId) 
    {
        return $this->findWhere(['fb_id' => $fbId])->first();
    }

    public function getListForChat() 
    {
        return $this->getBuilder()->where('id', '!=', frontendGuard()->user()->id)->get();
    }
}