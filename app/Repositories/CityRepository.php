<?php
namespace App\Repositories;

use App\Model\Entities\City;
use App\Repositories\Base\CustomRepository;

class CityRepository extends CustomRepository
{
    public function model()
    {
        return City::class;
    }
}