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

    public function getListForChat($userId) 
    {
    	$currentUserId = frontendGuard()->user()->id;
    	return $this->getBuilder()->where(function($q) use($currentUserId, $userId) {
    		$q->where('user_from_id', $currentUserId);
    		$q->where('user_to_id', $userId);
    	})->orWhere(function($q) use($currentUserId, $userId) {
    		$q->where('user_from_id', $userId);
    		$q->where('user_to_id', $currentUserId);
    	})->get();
    }
}