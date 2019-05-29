<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Rate;
use App\Repositories\RateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class RatesController
 * @package App\Http\Controllers\Frontend
 */
class RatesController extends FrontendController
{
    /**
     * RatesController constructor.
     * @param RateRepository $rateRepository
     * @param Rate $rate
     */
    public function __construct(
        RateRepository $rateRepository,
        Rate $rate
    )
    {
        $this->setRepository($rateRepository);
        $this->setAlias($rate->getTable());
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
    	$data = $request->all();
        // Create
        $data['user_id'] = frontendGuard()->user()->id;
        DB::beginTransaction();
        try {
            $this->getRepository()->create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        list($rates, $params['rates']) = $this->getRepository()->getListByPost(array_get($data, 'post_id'));
        return view('frontend.rates._list_rates', compact('rates', 'params'));
    }
}