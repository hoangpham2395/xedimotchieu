<?php
namespace App\Repositories;

use App\Model\Entities\User;
use App\Repositories\Base\CustomRepository;
use App\Validators\VUser;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return string|null
     */
    public function validator()
    {
        return VUser::class;
    }

    /**
     * @return array
     */
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

    /**
     * @param $fbId
     * @return mixed
     */
    public function findByFb($fbId)
    {
        return $this->findWhere(['fb_id' => $fbId])->first();
    }

    /**
     * @return mixed
     */
    public function getListForChat()
    {
        return $this->getBuilder()->where('id', '!=', frontendGuard()->user()->id)->get();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->findWhere(['email' => $email])->first();
    }
}