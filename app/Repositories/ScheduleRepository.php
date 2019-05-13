<?php
namespace App\Repositories;

use App\Model\Entities\Schedule;
use App\Repositories\Base\CustomRepository;

class ScheduleRepository extends CustomRepository
{
    public function model()
    {
        return Schedule::class;
    }

    public function getListByPostId($postId) 
    {
    	return $this->getBuilder()->where('post_id', '=', $postId)->get();
    }
}