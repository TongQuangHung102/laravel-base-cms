<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
    public function create(array $data): Comment
    {
        return $this->model->create($data);
    }
}
