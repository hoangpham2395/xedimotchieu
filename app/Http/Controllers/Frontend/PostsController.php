<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Repositories\PostRepository;
use App\Validators\VPost;
use App\Model\Entities\Post;
use Illuminate\Support\Facades\Input;

class PostsController extends FrontendController 
{
	public function __construct(
		PostRepository $postRepository,
		VPost $postValidator,
		Post $post
	) 
	{
		$this->setRepository($postRepository);
		$this->setValidator($postValidator);
		$this->setAlias($post->getTable());
		parent::__construct();
	}

	public function index() 
	{
		$params = $this->_prepareIndex();
		$userId = frontendGuard()->user()->id;
        $entities = $this->getRepository()->getListByUser($userId, Input::all());
        return view('frontend.' . $this->getAlias() . '.index', compact('entities', 'params'));
	}
}