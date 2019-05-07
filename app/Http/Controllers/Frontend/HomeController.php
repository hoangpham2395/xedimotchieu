<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Post;
use App\Repositories\PostRepository;
use App\Repositories\CityRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\RateRepository;
use App\Validators\VPost;
use Illuminate\Support\Facades\Input;

class HomeController extends FrontendController
{
    protected $_cityRepository;
    protected $_districtRepository;
    protected $_rateRepository;

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

    public function setRateRepository($rateRepository) 
    {
        $this->_rateRepository = $rateRepository;
    }

    public function getRateRepository() 
    {
        return $this->_rateRepository;
    }

    public function __construct(
        PostRepository $postRepository,
        VPost $postValidator,
        Post $post,
        CityRepository $cityRepository,
        DistrictRepository $districtRepository,
        RateRepository $rateRepository
    )
    {
        $this->setRepository($postRepository);
        $this->setCityRepository($cityRepository);
        $this->setDistrictRepository($districtRepository);
        $this->setRateRepository($rateRepository);
        $this->setValidator($postValidator);
        $this->setAlias($post->getTable());
        parent::__construct();
    }

    public function index() 
    {
        return view('frontend.home.index');
    }

    public function community() 
    {
        $data = Input::all();
        $params['listDistrictsFrom'] = $this->getDistrictRepository()->getListForSearch(array_get($data, 'city_from_id'));
        $params['listDistrictsTo'] = $this->getDistrictRepository()->getListForSearch(array_get($data, 'city_to_id'));
        $params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
        $params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
        $params['display_search'] = !empty($data['max_cost']) ? '' : 'display-none';
        $entities = $this->getRepository()->getListForHome($data);
        return view('frontend.home.community', compact('entities', 'params'));
    }

    protected function _prepareData() 
    {
        $params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
        $params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
        return array_merge($params, parent::_prepareData());
    }

    public function detail($id) 
    {
        $entity = $this->getRepository()->findById($id);
        list($rates, $params['rates']) = $this->getRateRepository()->getListByPost($id);
        $allowRate = $entity->isOwner() ? false : $this->_allowRate($rates);
        return view('frontend.home.detail', compact('entity', 'params', 'rates', 'allowRate'));
    }

    protected function _allowRate($rates) {
        if (!frontendGuard()->check() || empty($rates)) {
            return true;
        }

        foreach ($rates as $rate) {
            if ($rate->isOwner()) {
                return false;
            }
        }

        return true;
    }
}