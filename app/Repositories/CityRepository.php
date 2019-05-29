<?php
namespace App\Repositories;

use App\Model\Entities\City;
use App\Repositories\Base\CustomRepository;

/**
 * Class CityRepository
 * @package App\Repositories
 */
class CityRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return City::class;
    }
}