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

    public function getDataForDashboard()
    {
        return [
            'cars' => count($this->all()),
            'dataChart' => $this->statisticalByMonthInYear(),
        ];
    }
}