<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Post;
use App\Repositories\PostRepository;
use App\Validators\VPost;
use Illuminate\Support\Facades\Input;

class HomeController extends FrontendController
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
        $entities = $this->getRepository()->getListForFrontend(Input::all());
        return view('frontend.home.index', compact('entities', 'params'));
    }
}