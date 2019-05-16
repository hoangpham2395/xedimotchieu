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

class PostsController extends FrontendController 
{
	protected $_cityRepository;
	protected $_districtRepository;
	protected $_carRepository;
	protected $_scheduleRepository;

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

	public function setScheduleRepository($scheduleRepository) 
	{
		$this->_scheduleRepository = $scheduleRepository;
	}

	public function getScheduleRepository() 
	{
		return $this->_scheduleRepository;
	}

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
		$params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
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

    public function getSchedules($id) 
    {
    	$params['listCities'] = $this->getCityRepository()->getListForSelect('id', 'city_name');
		$params['listDistricts'] = $this->getDistrictRepository()->getListForPosts();
		$params['post_id'] = $id;
		$params['alias'] = $this->getAlias();
		$entity = $this->getRepository()->findById($id);
		$schedules = $this->getScheduleRepository()->getListByPostId($id);
    	return view('frontend.posts.schedules', compact('entity', 'params'));
    }

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
}