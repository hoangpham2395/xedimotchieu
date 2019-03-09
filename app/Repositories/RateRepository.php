<?php
namespace App\Repositories;

use App\Model\Entities\Rate;
use App\Repositories\Base\CustomRepository;

class RateRepository extends CustomRepository
{
    public function model()
    {
        return Rate::class;
    }
}