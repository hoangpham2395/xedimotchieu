<?php
namespace App\Repositories;

use App\Model\Entities\Post;
use App\Repositories\Base\CustomRepository;

class PostRepository extends CustomRepository
{
    public function model()
    {
        return Post::class;
    }
}