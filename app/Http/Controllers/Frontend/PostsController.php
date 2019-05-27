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

        $data = $request->all();

        // Upload file to tmp folder if exist
        $this->_uploadToTmpIfExist($request);

        // Validate
        $valid = $this->getValidator()->validateUpdate($data, $id);
        if (!$valid) {
            return redirect()->back()->withErrors($this->getValidator()->errors())->withInput();
        }

        // Update
        $data = array_merge($data, $this->_prepareUpdate());
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            // Move file to medias if exist
            $this->_moveToMediasIfExist($data);
            DB::commit();
            Session::flash('success', getMessage('update_success'));
            return redirect()->route('frontend.' . $this->getAlias() . '.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Update failed
        $this->_deleteFileInTmpIfExist();
        return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['update_failed' => getMessage('update_failed')]);
    }

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

        // Delete
        $data['del_flag'] = getConstant('DEL_FLAG.DELETED', 1);
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            //$this->_deleteFileIfExist();
            DB::commit();
            Session::flash('success', getMessage('delete_success'));
            return redirect()->route('frontend.' . $this->getAlias() . '.index');
        } catch(\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Delete failed
        return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['delete_failed' => getMessage('delete_failed')]);
    }
}