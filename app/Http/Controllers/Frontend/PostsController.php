<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Repositories\PostRepository;
use App\Repositories\CityRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\CarRepository;
use App\Validators\VPost;
use App\Model\Entities\Post;
use Illuminate\Support\Facades\Input;

class PostsController extends FrontendController 
{
	protected $_cityRepository;
	protected $_districtRepository;
	protected $_carRepository;

	public function setCityRepository($cityRepository) 
	{
		$this->_cityRepository = $cityRepository;
	}

	public function getCityRepository() 
	{
		return $this->_cityRepository;
	}

	public function setDistrictRepository($districtRepository) 
	{
		$this->_districtRepository = $districtRepository;
	}

	public function getDistrictRepository() 
	{
		return $this->_districtRepository;
	}

	public function setCarRepository($carRepository) 
	{
		$this->_carRepository = $carRepository;
	}

	public function getCarRepository() 
	{
		return $this->_carRepository;
	}

	public function __construct(
		PostRepository $postRepository,
		VPost $postValidator,
		Post $post,
		CityRepository $cityRepository,
		DistrictRepository $districtRepository,
		CarRepository $carRepository
	) 
	{
		$this->setRepository($postRepository);
		$this->setValidator($postValidator);
		$this->setCityRepository($cityRepository);
		$this->setDistrictRepository($districtRepository);
		$this->setCarRepository($carRepository);
		$this->setAlias($post->getTable());
		parent::__construct();
	}

	public function index() 
	{
		$params = $this->_prepareIndex();
		$userId = frontendGuard()->user()->id;
        $entities = $this->getRepository()->getListByUser($userId, Input::all());
        return view('frontend.' . $this->getAlias() . '.index', compact('entities', 'params'));
	}

	protected function _prepareData() 
	{
		$params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
		$params['listDistricts'] = $this->getDistrictRepository()->getListForSelect('id', 'district_name');
		if (!empty(frontendGuard()) && frontendGuard()->user()->isCarOwner()) {
			$params['listCars'] = $this->getCarRepository()->getListForSelectByUser(frontendGuard()->user()->id);
		} else {
			$params['listCars'] = getConfig('car_type');
		}
		return array_merge($params, parent::_prepareData());
	}

	protected function _prepareStore()
    {
        $params['user_id'] = frontendGuard()->user()->id;
        $params = array_merge($params, parent::_prepareStore());
        return $params;
    }

    protected function _prepareUpdate()
    {
        $params['user_id'] = frontendGuard()->user()->id;
        $params = array_merge($params, parent::_prepareUpdate());
        return $params;
    }
}