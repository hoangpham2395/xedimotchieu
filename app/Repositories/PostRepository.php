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

        if (empty($params) || (empty($params['schedule_city_id']) && empty($params['schedule_district_id']))) {
            return $this->_getListForHomeDefault($params);
        } 

        return $this->_getListForHomeSearch($params);
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

    protected function _getListForHomeDefault($params) 
    {
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

    protected function _getListForHomeSearch($params)
    {
        $postIds = $this->getBuilder()->with(['schedules'])
        ->select('posts.id')
        ->leftJoin('schedules', 'posts.id', '=', 'schedules.post_id')
        ->where(function ($query) use ($params) {
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

            if (!empty($params['schedule_city_id'])) {
                $query = $query->where('schedules.city_id', '=', $params['schedule_city_id']);
            }
            unset($params['schedule_city_id']);

            if (!empty($params['schedule_district_id'])) {
                $query = $query->where('schedules.district_id', '=', $params['schedule_district_id']);
            }
            unset($params['schedule_district_id']);

            foreach ($params as $key => $value) {
                if (empty($value)) {
                    continue;
                }
                $query = $query->where('posts.'.$key, '=', $value);
            }

            $query = $query->where('schedules.del_flag', '=', getConstant('DEL_FLAG.ACTIVE'));

            return $query;
        })
        ->groupBy('posts.id')
        ->get()->keyBy('id')->toArray('id');

        $listPostIds = array_keys($postIds);

        return $this->getBuilder()->with(['schedules', 'user'])
            ->whereIn('id', $listPostIds)
            ->orderBy($this->getSortField(), $this->getSortType())
            ->paginate(getConfig('frontend.per_page'));
    }

    public function getSuggest($id) 
    {
        $post = $this->findById($id);

        if (empty($post)) {
            return $post;
        }

        $dateStart = date('Y-m-d', strtotime($post->date_start)) . ' 00:00';
        $seats = $post->seats;

        if ($post->user->isCarOwner()) {
            $cityIds = []; $districtIds = [];
            foreach ($post->schedules as $schedule) {
                $cityIds[] = $schedule->city_id;
                $districtIds[] = $schedule->district_id;
            }

            $params = [
                'listCityFromId' => array_merge($cityIds, [$post->city_from_id]),
                'listCityToId' => array_merge($cityIds, [$post->city_to_id]),
                'listDistrictFromId' => array_merge($districtIds, [$post->district_from_id]),
                'listDistrictToId' => array_merge($districtIds, [$post->district_to_id]),
                'date_start' => $dateStart,
                'seats' => $seats,
                'type' => getConfig('user_type_passenger'),
            ]; 

            return $this->getBuilder()->where(function($q) use ($params) {
                $q = $q->where('date_start', '>=', $params['date_start'])
                       ->whereIn('city_from_id', $params['listCityFromId'])
                       ->whereIn('city_to_id', $params['listCityToId'])
                       ->whereIn('district_from_id', $params['listDistrictFromId'])
                       ->whereIn('district_to_id', $params['listDistrictToId'])
                       ->where('seats', '<=', $params['seats'])
                       ->where('type', '=', $params['type']);
                return $q;
            })->orderBy('date_start', 'asc')->limit(3)->get();

        } 

        // Passenger
        $params = [
            'date_start' => $dateStart,
            'seats' => $seats,
            'city_from_id' => $post->city_from_id,
            'city_to_id' => $post->city_to_id,
            'type' => getConfig('user_type_car_owner'),
        ];

        $postIds = $this->getBuilder()->with(['schedules'])
        ->select('posts.id')
        ->leftJoin('schedules', 'posts.id', '=', 'schedules.post_id')
        ->where(function ($query) use ($params) {
            $query = $query->where('posts.date_start', '>=', $params['date_start'])
                           ->where('posts.seats', '>=', (int) $params['seats'])
                           ->where('posts.type', '=', $params['type']);
            return $query;
        })
        ->where(function($query2) use ($params) {
            $query2 = $query2->where('schedules.city_id', '=', $params['city_from_id'])
                             ->orWhere('posts.city_from_id', '=', $params['city_from_id']);
            return $query2;
        })
        ->where(function($query3) use ($params) {
            $query3 = $query3->where('schedules.city_id', '=', $params['city_to_id'])
                             ->orWhere('posts.city_to_id', '=', $params['city_to_id']);
            return $query3;
        })
        ->groupBy('posts.id')
        ->get()->keyBy('id')->toArray('id');

        $listPostIds = array_keys($postIds);

        return $this->getBuilder()->with(['schedules', 'user'])
            ->whereIn('id', $listPostIds)
            ->orderBy($this->getSortField(), $this->getSortType())
            ->limit(3)->get();
    }
}