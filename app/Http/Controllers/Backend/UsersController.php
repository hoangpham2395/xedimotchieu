<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Model\Entities\User;
use App\Repositories\UserRepository;

class UsersController extends BackendController
{
    public function __construct(
        UserRepository $userRepository,
        User $user)
    {
        $this->setRepository($userRepository);
        $this->setAlias($user->getTable());
        parent::__construct();
    }
}