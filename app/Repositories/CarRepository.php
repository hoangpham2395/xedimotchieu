<?php
namespace App\Repositories;

use App\Model\Entities\Car;
use App\Repositories\Base\CustomRepository;

/**
 * Class CarRepository
 * @package App\Repositories
 */
class CarRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Car::class;
    }

    /**
     * @return array
     */
    public function getDataForDashboard()
    {
        return [
            'cars' => count($this->all()),
            'dataChart' => $this->statisticalByMonthInYear(),
        ];
    }

    /**
     * @param $userId
     * @return array
     */
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

    /**
     * @param $userId
     * @param array $params
     * @return mixed
     */
    public function getListByUser($userId, $params = [])
    {
        // Serve pagination
        if (isset($params['page'])) {
            unset($params['page']);
        }
        // Get data
        return $this->scopeQuery(function ($query) use ($userId, $params) {
            $query = $query->where('user_id', '=', $userId)->orderBy($this->getSortField(), $this->getSortType());
            if (empty($params)) {
                return $query;
            }
            // Search
            foreach ($params as $key => $value) {
                $query = $query->where($key, 'LIKE', '%' . $value . '%');
            }
            return $query;
        })
        ->paginate(getConfig('frontend.per_page'));
    }
}