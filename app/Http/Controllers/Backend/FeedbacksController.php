<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\FeedbackRepository;
use App\Model\Entities\Feedback;

class FeedbacksController extends BackendController 
{
	public function __construct(
		FeedbackRepository $feedbackRepository,
		Feedback $feedback
	) 
	{
		$this->setRepository($feedbackRepository);
		$this->setAlias($feedback->getTable());
		parent::__construct();
	}
}