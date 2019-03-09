<?php
namespace App\Repositories;

use App\Model\Entities\District;
use App\Repositories\Base\CustomRepository;

class DistrictRepository extends CustomRepository
{
    public function model()
    {
        return District::class;
    }
}