<?php
namespace App\Repositories;

use App\Model\Entities\District;
use App\Repositories\Base\CustomRepository;

/**
 * Class DistrictRepository
 * @package App\Repositories
 */
class DistrictRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return District::class;
    }

    /**
     * @return array
     */
    public function getListForPosts()
    {
    	$districts = $this->all();
    	return $this->_filterDistrict($districts);
    }

    /**
     * @param null $cityId
     * @return array
     */
    public function getListForSearch($cityId = null)
    {
        $districts = $this->scopeQuery(function($q) use ($cityId) {
            if (!empty($cityId)) {
                $q = $q->where('city_id', '=', $cityId);
            }            
            return $q;
        })->get();    
        return $this->_filterDistrict($districts);    
    }

    /**
     * @param $districts
     * @return array
     */
    protected function _filterDistrict($districts)
    {
        $r = [];
        if (empty($districts)) {
            return $r;
        }

        foreach ($districts as $district) {
            $r[$district->city->city_name][$district->id] = $district->district_name;
        }
        return $r;
    }
}