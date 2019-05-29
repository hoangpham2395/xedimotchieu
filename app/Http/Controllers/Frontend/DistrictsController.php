<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\District;
use App\Repositories\DistrictRepository;
use Illuminate\Http\Request;

/**
 * Class DistrictsController
 * @package App\Http\Controllers\Frontend
 */
class DistrictsController extends FrontendController
{
    /**
     * DistrictsController constructor.
     * @param DistrictRepository $districtRepository
     * @param District $district
     */
    public function __construct(
        DistrictRepository $districtRepository,
        District $district
    )
    {
        $this->setRepository($districtRepository);
        $this->setAlias($district->getTable());
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDistrictsByCity(Request $request)
    {
        $data = $request->all();
        $cityId = array_get($data, 'city_id');
        $districts = $this->getRepository()->findWhere(['city_id' => $cityId]);
        $listDistricts = [];

        if (!empty($districts)) {
            foreach ($districts as $district) {
                $listDistricts[$district->city->city_name][$district->id] = $district->district_name;
            }
        }

        $params = [
            'listDistricts' => $listDistricts,
            'field' => array_get($data, 'field'),
        ];

        return view('frontend.posts._districts', compact('params'));
    }
}