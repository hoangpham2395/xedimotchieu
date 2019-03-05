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
}