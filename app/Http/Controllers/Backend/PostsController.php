<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\PostRepository;
use App\Model\Entities\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PostsController extends BackendController 
{
	public function __construct(
		PostRepository $postRepository,
		Post $post
	) 
	{
		$this->setRepository($postRepository);
		$this->setAlias($post->getTable());
		parent::__construct();
	}

    public function destroy($id)
    {
        // Check id
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            return redirect()->route($this->getAlias() . '.index')->withErrors(['id_invalid' => getMessage('id_invalid')]);
        }
        // Delete
        $data['del_flag'] = getConstant('DEL_FLAG.DELETED', 1);
        DB::beginTransaction();
        try {
            $this->getRepository()->update($data, $id);
            DB::commit();

            $dataMail = [
                'email' => $entity->user->email,
                'name' => $entity->user->name,
                'note' => $entity->note,
            ];
            $this->_sendMail($dataMail);

            Session::flash('success', getMessage('delete_success'));
            return redirect()->route('backend.posts.index');
        } catch(\Exception $e) {
            DB::rollBack();
            logError($e);
        }
        // Delete failed
        return redirect()->route($this->getAlias() . '.index')->withErrors(['delete_failed' => getMessage('delete_failed')]);
    }

    protected function _sendMail($data)
    {
        try {
            Mail::send('backend.posts.mail', $data, function($message) use ($data) {
                $message->to(array_get($data, 'email'), array_get($data, 'name'))->subject('Thông báo');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}