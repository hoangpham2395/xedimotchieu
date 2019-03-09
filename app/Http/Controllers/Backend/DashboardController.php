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
 * 
 */
class DashboardController extends BackendController
{
	protected $_userRepository;
	protected $_postRepository;
	protected $_carRepository;

	public function setUserRepository($userRepository) 
	{
		$this->_userRepository = $userRepository;
	}

	public function getUserRepository() 
	{
		return $this->_userRepository;
	}

	public function setCarRepository($carRepository) 
	{
		$this->_carRepository = $carRepository;
	}

	public function getCarRepository() 
	{
		return $this->_carRepository;
	}

	public function setPostRepository($postRepository) 
	{
		$this->_postRepository = $postRepository;
	}

	public function getPostRepository() 
	{
		return $this->_postRepository;
	}

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

	public function index() 
	{
		$users = $this->getUserRepository()->getCount();
		$posts = $this->getPostRepository()->getList();
		$cars = $this->getCarRepository()->getList();

		$params = [
			'users' => array_get($users, 'users'),
			'car_owner' => array_get($users, 'car_owner'),
			'passenger' => array_get($users, 'passenger'),
			'cars' => count($cars),
			'posts' => count($posts),
		];
		return view('backend.dashboard.index', compact('params'));
	}
}