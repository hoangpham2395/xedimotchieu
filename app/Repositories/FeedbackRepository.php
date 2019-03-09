<?php
namespace App\Repositories;

use App\Model\Entities\Feedback;
use App\Repositories\Base\CustomRepository;

class FeedbackRepository extends CustomRepository
{
    public function model()
    {
        return Feedback::class;
    }
}