<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Feedback;
use App\Repositories\FeedbackRepository;
use App\Validators\VFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

/**
 * Class FeedbacksController
 * @package App\Http\Controllers\Frontend
 */
class FeedbacksController extends FrontendController
{
    /**
     * FeedbacksController constructor.
     * @param FeedbackRepository $feedbackRepository
     * @param VFeedback $feedbackValidator
     * @param Feedback $feedback
     */
    public function __construct(
        FeedbackRepository $feedbackRepository,
        VFeedback $feedbackValidator,
        Feedback $feedback
    )
    {
        $this->setRepository($feedbackRepository);
        $this->setValidator($feedbackValidator);
        $this->setAlias($feedback->getTable());
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (frontendGuard()->check()) {
            $data['email'] = frontendGuard()->user()->email;
        }

        // Validate
        $valid = $this->getValidator()->validateCreate($data);
        if (!$valid) {
            return redirect()->back()->withErrors($this->getValidator()->errors())->withInput();
        }

        // Create
        DB::beginTransaction();
        try {
            $this->getRepository()->create($data);
            DB::commit();

            Session::flash('success', getMessage('create_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Create failed
        return redirect()->back()->withErrors(['create_failed' => getMessage('create_failed')]);
    }
}