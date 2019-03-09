<?php
namespace App\Repositories;

use App\Model\Entities\Comment;
use App\Repositories\Base\CustomRepository;

class CommentRepository extends CustomRepository
{
    public function model()
    {
        return Comment::class;
    }
}