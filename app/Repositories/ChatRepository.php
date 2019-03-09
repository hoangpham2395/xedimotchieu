<?php
namespace App\Repositories;

use App\Model\Entities\Chat;
use App\Repositories\Base\CustomRepository;

class ChatRepository extends CustomRepository
{
    public function model()
    {
        return Chat::class;
    }
}