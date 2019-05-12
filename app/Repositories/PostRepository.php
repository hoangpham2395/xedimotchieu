<?php
namespace App\Repositories;

use App\Model\Entities\Post;
use App\Repositories\Base\CustomRepository;
use Illuminate\Support\Facades\DB;

class PostRepository extends CustomRepository
{
    public function model()
    {
        return Post::class;
    }

    public function getDataForDashboard()
    {
    	$posts = $this->all();
    	$cities = [];

    	foreach($posts as $post) {
    		if (!in_array($post->city_from_id, $cities)) {
    			array_push($cities, $post->city_from_id);
    		}

    		if (!in_array($post->city_to_id, $cities)) {
    			array_push($cities, $post->city_to_id);
    		}
    	}

    	return [
    		'posts' => count($posts),
    		'cities' => count($cities),
            'dataChart' => $this->statisticalByMonthInYear(),
    	];
    }

    public function getListForBackend($params = [])
    {
        // Serve pagination
        if (isset($params['page'])) {
            unset($params['page']);
        }
        // Get data
        $result = $this->getBuilder()->with(['user'])->join('users', 'posts.user_id', '=', 'users.id')
            ->where(function ($query) use ($params) {
                $query = $query->orderBy($this->getSortField(), $this->getSortType());
                if (empty($params)) {
                    return $query;
                }
                // Search
                if (!empty($params['username'])) {
                    $query = $query->where('users.name', 'LIKE', '%'.$params['username'].'%');
                }

                if (!empty($params['date_start'])) {
                    $dateStart = date('Y-m-d H:i:s', strtotime($params['date_start']));
                    $dateEnd = date('Y-m-d', strtotime($params['date_start'])) . ' 23:59:59';
                    $query = $query->where('date_start', '>=', $dateStart)->where('date_start', '<=', $dateEnd);
                }

                return $query;
            });

        return $result->paginate($this->getPerPage());
    }

    public function getListForHome($params = []) 
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

            // Cost
            if (!empty($params['min_cost'])) {
                $minCost = array_get($params, 'min_cost') * 1000000;
                $query = $query->where('cost', '>=', $minCost);
            }
            unset($params['min_cost']);

            if (!empty($params['max_cost'])) {
                $maxCost = array_get($params, 'max_cost') * 1000000;
                $query = $query->where('cost', '<=', $maxCost);
            }
            unset($params['max_cost']);

            // Date start
            if (!empty($params['date_start'])) {
                $dateStart = array_get($params, 'date_start');
                $query = $query->where('date_start', '>=', $dateStart);
            }
            unset($params['date_start']);

            // Seats
            if (!empty($params['min_seat'])) {
                $query = $query->where('seats', '>=', (int) $params['min_seat']);
            }
            unset($params['min_seat']);

            if (!empty($params['max_seat'])) {
                $query = $query->where('seats', '<=', (int) $params['max_seat']);
            }
            unset($params['max_seat']);

            foreach ($params as $key => $value) {
                if (empty($value)) {
                    continue;
                }
                $query = $query->where($key, '=', $value);
            }
            return $query;
        })
        ->paginate(getConfig('frontend.per_page'));
    }

    public function getListByUser($userId, $params = []) 
    {
        // Serve pagination
        if (isset($params['page'])) {
            unset($params['page']);
        }
        // Get data
        return $this->scopeQuery(function ($query) use ($userId, $params) {
            $query = $query->where('user_id', '=', $userId)->orderBy($this->getSortField(), $this->getSortType());
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
}