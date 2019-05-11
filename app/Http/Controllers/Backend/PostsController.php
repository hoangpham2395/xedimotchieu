<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\PostRepository;
use App\Model\Entities\Post;

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
}