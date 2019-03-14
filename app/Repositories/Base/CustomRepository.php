<?php 
namespace App\Repositories\Base;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * 
 */
class CustomRepository extends BaseRepository
{
	function model() 
	{
		return "";
	}

	protected $_sortField = 'id';
    protected $_sortType = 'DESC';
    protected $_perPage = 10;
    
	public function setSortField($sortField) 
	{
		$this->_sortField = $sortField;
	}

	public function getSortField() 
	{
		return $this->_sortField;
	}

	public function setSortType($sortType) 
	{
		$this->_sortType = $sortType;
	}

	public function getSortType() 
	{
		return $this->_sortType;
	}

	public function setPerPage($perPage) 
	{
		$this->_perPage = $perPage;
	}

	public function getPerPage() 
	{
		return $this->_perPage;
	}

	public function getListForBackend($params = [])
	{
		// Serve pagination
		if (isset($params['page'])) {
			unset($params['page']);
		}
        // Get data
		return $this->scopeQuery(function ($query) use ($params) {
			$query = $query->orderBy($this->getSortField(), $this->getSortType());
			if (empty($params)) {
				return $query;
			}
			// Search
			foreach ($params as $key => $value) {
				$query = $query->where($key, 'LIKE', '%' . $value . '%');
			}
			return $query;
		})
		->paginate($this->getPerPage());
	}

    public function getListForFrontend($params = [])
    {
        // Serve pagination
        if (isset($params['page'])) {
            unset($params['page']);
        }
        // Get data
        return $this->scopeQuery(function ($query) use ($params) {
            $query = $query->orderBy($this->getSortField(), $this->getSortType());
            if (empty($params)) {
                return $query;
            }
            // Search
            foreach ($params as $key => $value) {
                $query = $query->where($key, 'LIKE', '%' . $value . '%');
            }
            return $query;
        })
        ->paginate(getConfig('frontend.per_page'));
    }

	public function findById($id)
    {
        return $this->findWhere(['id' => $id])->first();
    }

	// Custom create form BaseRepository in L5
    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
    }

    // Custom update form BaseRepository in L5
    public function update(array $attributes, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    public function delete($id)
    {
	    $attributes = [
	        'del_flag' => getConstant('DEL_FLAG.DELETED')
        ];
	    return $this->update($attributes, $id);
    }

    public function getList()
    {
        return $this->all();
    }

    public function getListForSelect($columnId, $columnName)
    {
        $list = $this->all([$columnId, $columnName]);

        if (empty($list)) {
            return [];
        }

        return $list->pluck($columnName, $columnId)->toArray();
    }

    // Custom builder by laravel core
    public function getBuilder()
    {
        return $this->model()::select('*');
    }

    public function statisticalByMonthInYear()
    {
        $r = [];
        $entities = $this->getBuilder()
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(MONTH(created_at)) as count'))
            ->where(DB::raw('YEAR(created_at)'), date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        if (empty($entities)) {
            return $r;
        }

        foreach ($entities as $entity) {
            $r[$entity->month] = $entity->count;
        }

        return $r;
    }
}