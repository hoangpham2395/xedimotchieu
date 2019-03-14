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

    public function getListForSelectByUser($userId) 
    {
        $cars = $this->findWhere(['user_id' => $userId]);
        $r = [];
        if (empty($cars)) {
            return $r;
        }
        foreach ($cars as $car) {
            $r[$car->id] = $car->car_name . ' - ' . $car->getCarType();
        }
        return $r;
    }
}