<?php
namespace App\Repositories;

use App\Model\Entities\Rate;
use App\Repositories\Base\CustomRepository;

class RateRepository extends CustomRepository
{
    public function model()
    {
        return Rate::class;
    }

    protected $_sortField = 'created_at';

    public function getListByPost($postId) 
    {
    	return $this->scopeQuery(function ($query) use ($postId) {
			return $query->orderBy($this->getSortField(), $this->getSortType())->where('post_id', '=', $postId);
		})
		->paginate(getConfig('frontend.rates.per_page'))
		->setPath(''); 
		// setPath(): Config url -> community/{postId}. 
		// Ex: http://dev.xdmc.vn/community/25?page=2. 
		// Default: http://dev.xdmc.vn/client/rates?page=2 (by route of this controller)
    }
}