<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ChatRepository;
use App\Repositories\UserRepository;
use App\Model\Entities\Chat;
use App\Events\NewMessage;

class ChatController extends FrontendController
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
		ChatRepository $chatRepository,
		UserRepository $userRepository,
		Chat $chat
	)
	{
		$this->setRepository($chatRepository);
		$this->setUserRepository($userRepository);
		$this->setAlias($chat->getTable());
		parent::__construct();
	}

	public function index() 
	{
		return view('frontend.chat.index');
	}

	public function get() 
	{
		$contacts = $this->getUserRepository()->getListForChat();

		return response()->json($contacts);
	}

	public function getMessagesFor($id) 
	{
		$messages = $this->getRepository()->getListForChat($id);

		return response()->json($messages); 
	}

	public function send(Request $request) 
	{
		$data = [
			'user_from_id' => frontendGuard()->user()->id,
			'user_to_id' => $request->user_to_id,
			'content' => $request->content,
		];

		$message = null;

		DB::beginTransaction();
		try {
			$message = $this->getRepository()->create($data);
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
		}

		broadcast(new NewMessage($message));

		return response()->json($message);
	}
}