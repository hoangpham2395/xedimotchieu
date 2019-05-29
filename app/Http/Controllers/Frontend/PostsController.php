<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Repositories\PostRepository;
use App\Repositories\CityRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\CarRepository;
use App\Repositories\ScheduleRepository;
use App\Validators\VPost;
use App\Model\Entities\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class PostsController
 * @package App\Http\Controllers\Frontend
 */
class PostsController extends FrontendController
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
    protected $_carRepository;
    /**
     * @var
     */
    protected $_scheduleRepository;

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
     * @param $carRepository
     */
    public function setCarRepository($carRepository)
	{
		$this->_carRepository = $carRepository;
	}

    /**
     * @return mixed
     */
    public function getCarRepository()
	{
		return $this->_carRepository;
	}

    /**
     * @param $scheduleRepository
     */
    public function setScheduleRepository($scheduleRepository)
	{
		$this->_scheduleRepository = $scheduleRepository;
	}

    /**
     * @return mixed
     */
    public function getScheduleRepository()
	{
		return $this->_scheduleRepository;
	}

    /**
     * PostsController constructor.
     * @param PostRepository $postRepository
     * @param VPost $postValidator
     * @param Post $post
     * @param CityRepository $cityRepository
     * @param DistrictRepository $districtRepository
     * @param CarRepository $carRepository
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(
		PostRepository $postRepository,
		VPost $postValidator,
		Post $post,
		CityRepository $cityRepository,
		DistrictRepository $districtRepository,
		CarRepository $carRepository,
		ScheduleRepository $scheduleRepository
	) 
	{
		$this->setRepository($postRepository);
		$this->setValidator($postValidator);
		$this->setCityRepository($cityRepository);
		$this->setDistrictRepository($districtRepository);
		$this->setCarRepository($carRepository);
		$this->setScheduleRepository($scheduleRepository);
		$this->setAlias($post->getTable());
		parent::__construct();
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
	{
		$params = $this->_prepareIndex();
		$userId = frontendGuard()->user()->id;
        $entities = $this->getRepository()->getListByUser($userId, Input::all());
        return view('frontend.' . $this->getAlias() . '.index', compact('entities', 'params'));
	}

    /**
     * @return array|mixed
     */
    protected function _prepareData()
	{
		$params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
		$params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
		if (!empty(frontendGuard()) && frontendGuard()->user()->isCarOwner()) {
			$params['listCars'] = $this->getCarRepository()->getListForSelectByUser(frontendGuard()->user()->id);
		} else {
			$params['listCars'] = getConfig('car_type');
		}
		return array_merge($params, parent::_prepareData());
	}

    /**
     * @return array|mixed
     */
    protected function _prepareStore()
    {
        $params['user_id'] = frontendGuard()->user()->id;
        $data = Input::all();
        if (!empty($data['car_id'])) {
        	$car = $this->getCarRepository()->findById($data['car_id']);
        	if (!empty($car)) {
        		$params['car_type'] = $car->car_type;
        	}
        }
        $params = array_merge($params, parent::_prepareStore());
        return $params;
    }

    /**
     * @return array|mixed
     */
    protected function _prepareUpdate()
    {
        $params['user_id'] = frontendGuard()->user()->id;
        $data = Input::all();
        if (!empty($data['car_id'])) {
        	$car = $this->getCarRepository()->findById($data['car_id']);
        	if (!empty($car)) {
        		$params['car_type'] = $car->car_type;
        	}
        }
        $params = array_merge($params, parent::_prepareUpdate());
        return $params;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getSchedules($id)
    {
        if (!frontendGuard()->user()->isCarOwner()) {
            return redirect()->route('frontend.posts.index');
        }
    	$params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
		$params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
		$params['post_id'] = $id;
		$params['alias'] = $this->getAlias();
		$entity = $this->getRepository()->findById($id);
		$schedules = $this->getScheduleRepository()->getListByPostId($id);
    	return view('frontend.posts.schedules', compact('entity', 'params'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSchedules(Request $request)
    {
    	$data = $request->all();

    	// Validate


    	DB::beginTransaction();
    	try {
            // Delete old schedule
	    	$postId = array_get($data, 'post_id');
	    	$oldSchedules = $this->getScheduleRepository()->getListByPostId($postId);
	    	foreach ($oldSchedules as $oldSchedule) {
	    		$this->getScheduleRepository()->delete($oldSchedule->id);
	    	}

	    	// Add new schedule
	    	$schedules = [];
	    	$cities = array_get($data, 'city_id');

	    	foreach ($cities as $key => $city) {
	    		$time = array_get($data, 'time.'.$key);
	    		$schedules[$key] = [
	    			'post_id' => $postId,
	    			'city_id' => $city,
	    			'district_id' => array_get($data, 'district_id.'.$key),
	    			'time' => !empty($time) ? date('H:i', strtotime($time)) : null,
	    		];
	    	}

	    	foreach ($schedules as $schedule) {
	    		$this->getScheduleRepository()->create($schedule);
	    	}

            DB::commit();
            Session::flash('success', getMessage('add_schedule_success'));
            return redirect()->route('frontend.' . $this->getAlias() . '.index');
        } catch(\Exception $e) {
            DB::rollBack();
            logError($e);            
            return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['create_failed' => getMessage('add_schedule_failed')]);
        } 	
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $params = $this->_prepareEdit();
        $entity = $this->getRepository()->findById($id);

        // Check post is owner
        if (!$entity->isOwner()) {
            throw new HttpException('404');
        }

        // Check id
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        return view('frontend.' . $this->getAlias() . '.edit', compact(['entity', 'params']));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check is owner
        if (!$entity->isOwner()) {
            throw new HttpException('404');
        }

        return parent::update($request, $id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        // Check is owner
        if (!$entity->isOwner()) {
            throw new HttpException('404');
        }

        return parent::destroy($id);
    }
}