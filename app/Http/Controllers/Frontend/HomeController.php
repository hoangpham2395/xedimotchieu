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

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends FrontendController
{
    /**
     * @var
     */
    protected $_cityRepository;
    /**
     * @var
     */
    protected $_districtRepository;
    /**
     * @var
     */
    protected $_rateRepository;

    /**
     * @param $cityRepository
     */
    public function setCityRepository($cityRepository)
    {
        $this->_cityRepository = $cityRepository;
    }

    /**
     * @return mixed
     */
    public function getCityRepository()
    {
        return $this->_cityRepository;
    }

    /**
     * @param $districtRepository
     */
    public function setDistrictRepository($districtRepository)
    {
        $this->_districtRepository = $districtRepository;
    }

    /**
     * @return mixed
     */
    public function getDistrictRepository()
    {
        return $this->_districtRepository;
    }

    /**
     * @param $rateRepository
     */
    public function setRateRepository($rateRepository)
    {
        $this->_rateRepository = $rateRepository;
    }

    /**
     * @return mixed
     */
    public function getRateRepository()
    {
        return $this->_rateRepository;
    }

    /**
     * HomeController constructor.
     * @param PostRepository $postRepository
     * @param VPost $postValidator
     * @param Post $post
     * @param CityRepository $cityRepository
     * @param DistrictRepository $districtRepository
     * @param RateRepository $rateRepository
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.home.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @return array|mixed
     */
    protected function _prepareData()
    {
        $params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
        $params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
        return array_merge($params, parent::_prepareData());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $entity = $this->getRepository()->findById($id);
        list($rates, $params['rates']) = $this->getRateRepository()->getListByPost($id);
        $allowRate = $entity->isOwner() ? false : $this->_allowRate($rates);
        $isSuggest = false;
        return view('frontend.home.detail', compact('entity', 'params', 'rates', 'allowRate', 'isSuggest'));
    }

    /**
     * @param $rates
     * @return bool
     */
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSuggest($id)
    {
        $entity = $this->getRepository()->findById($id);
        list($rates, $params['rates']) = $this->getRateRepository()->getListByPost($id);
        $allowRate = $entity->isOwner() ? false : $this->_allowRate($rates);

        $suggests = $this->getRepository()->getSuggest($id);
        $isSuggest = true;
        return view('frontend.home.detail', compact('entity', 'params', 'rates', 'allowRate', 'isSuggest', 'suggests'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function introduction()
    {
        return view('frontend.home.introduction');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guide()
    {
        return view('frontend.home.guide');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function policy()
    {
        return view('frontend.home.policy');
    }
}