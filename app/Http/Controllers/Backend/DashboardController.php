<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\AdminRepository;
use App\Repositories\PostRepository;
use App\Repositories\CarRepository;
use App\Repositories\UserRepository;
use App\Validators\VAdmin;
use App\Model\Entities\Admin;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends BackendController
{
    /**
     * @var
     */
    protected $_userRepository;
    /**
     * @var
     */
    protected $_postRepository;
    /**
     * @var
     */
    protected $_carRepository;

    /**
     * @param $userRepository
     */
    public function setUserRepository($userRepository)
	{
		$this->_userRepository = $userRepository;
	}

    /**
     * @return mixed
     */
    public function getUserRepository()
	{
		return $this->_userRepository;
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
     * @param $postRepository
     */
    public function setPostRepository($postRepository)
	{
		$this->_postRepository = $postRepository;
	}

    /**
     * @return mixed
     */
    public function getPostRepository()
	{
		return $this->_postRepository;
	}

    /**
     * DashboardController constructor.
     * @param AdminRepository $adminRepository
     * @param VAdmin $adminValidator
     * @param Admin $admin
     * @param UserRepository $userRepository
     * @param PostRepository $postRepository
     * @param CarRepository $carRepository
     */
    public function __construct(
		AdminRepository $adminRepository, 
		VAdmin $adminValidator, 
		Admin $admin,
		UserRepository $userRepository, 
		PostRepository $postRepository,
	 	CarRepository $carRepository) 
	{
		$this->setRepository($adminRepository);
		$this->setUserRepository($userRepository);
		$this->setCarRepository($carRepository);
		$this->setPostRepository($postRepository);
		$this->setValidator($adminValidator);
		$this->setAlias($admin->getTable());
		parent::__construct();
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
	{
		$users = $this->getUserRepository()->getDataForDashboard();
		$posts = $this->getPostRepository()->getDataForDashboard();
		$cars = $this->getCarRepository()->getDataForDashboard();
		$dataChart = [];
		for ($i = 1; $i <= 12; $i ++) {
		    $dataChart[] = [
		        'month' => date('Y-') . ljust($i, 2, '0'),
                'user' => array_get($users, 'dataChart.' . $i, 0),
                'post' => array_get($posts, 'dataChart.' . $i, 0),
                'car' => array_get($cars, 'dataChart.' . $i, 0),
            ];
        }

		$params = [
			'users' => array_get($users, 'users'),
			'car_owner' => array_get($users, 'car_owner'),
			'passenger' => array_get($users, 'passenger'),
			'cars' => array_get($cars, 'cars'),
			'posts' => array_get($posts, 'posts'),
			'cities' => array_get($posts, 'cities'),
            'dataChart' => $dataChart,
		];
		return view('backend.dashboard.index', compact('params'));
	}
}