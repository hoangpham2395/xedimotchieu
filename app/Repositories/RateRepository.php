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
    	$rates = $this->scopeQuery(function ($query) use ($postId) {
			return $query->orderBy($this->getSortField(), $this->getSortType())->where('post_id', '=', $postId);
		})
		->paginate(getConfig('frontend.rates.per_page'))
		->setPath(''); 
		// setPath(): Config url -> community/{postId}. 
		// Ex: http://dev.xdmc.vn/community/25?page=2. 
		// Default: http://dev.xdmc.vn/client/rates?page=2 (by route of this controller)
        
        $dataRates['rating_breakdown'] = [];
        $total = $rates->total();
        $avg = 0;

        foreach (getConfig('rating_breakdown') as $key => $item) {
            $count = $this->_getCount($postId, $key);
            $dataRates['rating_breakdown'][$key] = [
                'count' => $count,
                'per_cent' => $total > 0 ? $count / $total * 100 : 0,
            ];
            $avg += $count * $key;
        }
        $dataRates['average_rating'] = $total > 0 ? number_format($avg / $total, 1) : 0;

        return [$rates, $dataRates];
    }

    protected function _getCount($postId, $rate) 
    {
        return count($this->findWhere(['post_id' => $postId, 'rate' => $rate]));
    }
}