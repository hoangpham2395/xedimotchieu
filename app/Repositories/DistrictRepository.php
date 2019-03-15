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

    public function getListForPosts() 
    {
    	$r = [];
    	$districts = $this->all();
    	if (empty($districts)) {
    		return $r;
    	}

    	foreach ($districts as $district) {
    		$r[$district->city->city_name][$district->id] = $district->district_name;
    	}
    	return $r;
    }
}