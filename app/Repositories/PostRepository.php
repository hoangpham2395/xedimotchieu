<?php
namespace App\Repositories;

use App\Model\Entities\Post;
use App\Repositories\Base\CustomRepository;

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