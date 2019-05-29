<?php
namespace App\Repositories;

use App\Model\Entities\Schedule;
use App\Repositories\Base\CustomRepository;

/**
 * Class ScheduleRepository
 * @package App\Repositories
 */
class ScheduleRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Schedule::class;
    }

    /**
     * @param $postId
     * @return mixed
     */
    public function getListByPostId($postId)
    {
    	return $this->getBuilder()->where('post_id', '=', $postId)->get();
    }
}