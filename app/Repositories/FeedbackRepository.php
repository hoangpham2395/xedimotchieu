<?php
namespace App\Repositories;

use App\Model\Entities\Feedback;
use App\Repositories\Base\CustomRepository;
use App\Validators\VFeedback;

class FeedbackRepository extends CustomRepository
{
    public function model()
    {
        return Feedback::class;
    }

    public function validator() 
    {
    	return VFeedback::class;
    }
}