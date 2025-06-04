<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(array $data): Comment
    {
        $data['user_id'] = Auth::id();
        return $this->commentRepository->create($data);
    }
}
