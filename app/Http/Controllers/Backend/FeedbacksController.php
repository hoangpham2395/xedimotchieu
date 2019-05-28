<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\FeedbackRepository;
use App\Repositories\UserRepository;
use App\Model\Entities\Feedback;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;

class FeedbacksController extends BackendController 
{
	protected $_userRepository;

	public function setUserRepository($userRepository) 
	{
		$this->_userRepository = $userRepository;
	}

	public function getUserRepository() 
	{
		return $this->_userRepository;
	}

	public function __construct(
		FeedbackRepository $feedbackRepository,
		Feedback $feedback,
		UserRepository $userRepository
	) 
	{
		$this->setRepository($feedbackRepository);
		$this->setAlias($feedback->getTable());
		$this->setUserRepository($userRepository);
		parent::__construct();
	}

	public function reply() 
	{
		$data = Input::all();

		$email = array_get($data, 'email');

		$user = $this->getUserRepository()->findByEmail($email);

		$data['name'] = $user->name;

		try {
			Mail::send('backend.feedbacks.mail', $data, function($message) use ($data) {
	         	$message->to(array_get($data, 'email'), array_get($data, 'name'))->subject(env('MAIL_FROM_NAME'));
	         	$message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
	      	});

	      	Session::flash('success', getMessage('send_feedback_success'));
            return redirect()->route('feedbacks.index');
		} catch(\Exception $e) {
			return redirect()->route('feedbacks.index')->withErrors(['send_failed' => getMessage('send_mail_fail')]);
		}
	}
}