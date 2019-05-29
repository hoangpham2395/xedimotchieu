<?php
namespace App\Repositories;

use App\Model\Entities\Comment;
use App\Repositories\Base\CustomRepository;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository extends CustomRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }
}