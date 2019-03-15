<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Post;
use App\Repositories\PostRepository;
use App\Repositories\CityRepository;
use App\Repositories\DistrictRepository;
use App\Validators\VPost;
use Illuminate\Support\Facades\Input;

class HomeController extends FrontendController
{
    protected $_cityRepository;
    protected $_districtRepository;

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

    public function __construct(
        PostRepository $postRepository,
        VPost $postValidator,
        Post $post,
        CityRepository $cityRepository,
        DistrictRepository $districtRepository
    )
    {
        $this->setRepository($postRepository);
        $this->setCityRepository($cityRepository);
        $this->setDistrictRepository($districtRepository);
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
        $entities = $this->getRepository()->getListForHome($data);
        return view('frontend.home.community', compact('entities', 'params'));
    }

    protected function _prepareData() 
    {
        $params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
        $params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
        return array_merge($params, parent::_prepareData());
    }
}