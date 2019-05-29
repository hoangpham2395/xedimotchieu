<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ChatRepository;
use App\Repositories\UserRepository;
use App\Model\Entities\Chat;
use App\Events\NewMessage;

/**
 * Class ChatController
 * @package App\Http\Controllers\Frontend
 */
class ChatController extends FrontendController
{
    /**
     * @var
     */
    protected $_userRepository;

    /**
     * @param $userRepository
     */
    public function setUserRepository($userRepository)
	{
		$this->_userRepository = $userRepository;
	}

    /**
     * @return mixed
     */
    public function getUserRepository()
	{
		return $this->_userRepository;
	}

    /**
     * ChatController constructor.
     * @param ChatRepository $chatRepository
     * @param UserRepository $userRepository
     * @param Chat $chat
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
	{
		return view('frontend.chat.index');
	}

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
	{
		$contacts = $this->getUserRepository()->getListForChat();

		// get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = $this->getRepository()->getListUnreadIds();

        $contacts = $contacts->map(function($contact) use($unreadIds) {
        	$contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

		return response()->json($contacts);
	}

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessagesFor($id)
	{
		$messages = $this->getRepository()->getListForChat($id);

		return response()->json($messages); 
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRead(Request $request)
	{
		$userFromId = $request->user_from_id;
		$messages = $this->getRepository()->getListForUpdateRead($userFromId);
		$status = false;

		DB::beginTransaction();
		try {
			foreach($messages as $message) {
				$data = [
					'id' => $message->id,
					'read' => getConstant('CHAT_READ'),
				];

				$this->getRepository()->update($data, $message->id);
			}
			DB::commit();

			$status = true;
		} catch(\Exception $e) {
			DB::rollBack();
		}

		return response()->json(['status' => $status]);
	}
}