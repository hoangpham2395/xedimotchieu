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

    public function getListUnreadIds() 
    {
        return $this->getBuilder()
            ->select(\DB::raw('`user_from_id` as sender_id, count(`user_from_id`) as messages_count'))
            ->where('user_to_id', frontendGuard()->user()->id)
            ->where('read', getConstant('CHAT_UNREAD'))
            ->groupBy('user_from_id')
            ->get();
    }

    public function getListForUpdateRead($userFromId) 
    {
        return $this->getBuilder()
            ->where('user_from_id', $userFromId)
            ->where('user_to_id', frontendGuard()->user()->id)
            ->where('read', getConstant('CHAT_UNREAD'))
            ->get();
    }
}