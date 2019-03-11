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
}