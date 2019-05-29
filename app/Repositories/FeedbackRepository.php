<?php
namespace App\Repositories;

use App\Model\Entities\Feedback;
use App\Repositories\Base\CustomRepository;
use App\Validators\VFeedback;

/**
 * Class FeedbackRepository
 * @package App\Repositories
 */
class FeedbackRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Feedback::class;
    }

    /**
     * @return string|null
     */
    public function validator()
    {
    	return VFeedback::class;
    }
}