<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Car;
use App\Repositories\CarRepository;
use App\Validators\VCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CarsController extends FrontendController
{
    public function __construct(
        CarRepository $carRepository,
        VCar $carValidator,
        Car $car
    )
    {
        $this->setRepository($carRepository);
        $this->setValidator($carValidator);
        $this->setAlias($car->getTable());
        parent::__construct();
    }

    public function index() 
    {
        $user = frontendGuard()->user();
        if (!$user->isCarOwner()) {
            return redirect()->route('home.index');
        }
        $params = $this->_prepareIndex();
        $entities = $this->getRepository()->getListByUser($user->id, Input::all());
        return view('frontend.' . $this->getAlias() . '.index', compact('entities', 'params'));
    }

    public function create() 
    {
        $user = frontendGuard()->user();
        if (!$user->isCarOwner()) {
            return redirect()->route('home.index');
        }
        return parent::create();
    }

    public function edit($id) 
    {
        $user = frontendGuard()->user();
        if (!$user->isCarOwner()) {
            return redirect()->route('home.index');
        }
        $params = $this->_prepareEdit();
        $entity = $this->getRepository()->findById($id);
        // Check id
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        if (!$entity->isOwner()) {
            throw new HttpException("404");
        }

        return view('frontend.' . $this->getAlias() . '.edit', compact(['entity', 'params']));
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

    public function store(Request $request) 
    {
        $user = frontendGuard()->user();
        if (!$user->isCarOwner()) {
            return redirect()->route('home.index');
        }
        return parent::store($request);
    }

    public function update(Request $request, $id) 
    {
        $user = frontendGuard()->user();
        if (!$user->isCarOwner()) {
            return redirect()->route('home.index');
        }

        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route('frontend.' . $this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }

        if (!$entity->isOwner()) {
            throw new HttpException("404");
        }

        return parent::update($request, $id);
    }

    public function destroy($id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }
        
        if (!$entity->isOwner()) {
            throw new HttpException("404");
        }

        return parent::destroy($id);
    }
}