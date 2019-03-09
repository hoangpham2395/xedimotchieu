<?php
namespace App\Repositories;

use App\Model\Entities\Car;
use App\Repositories\Base\CustomRepository;

class CarRepository extends CustomRepository
{
    public function model()
    {
        return Car::class;
    }
}