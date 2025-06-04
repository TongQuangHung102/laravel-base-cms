<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Frontend\CommentRequest;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('auth');
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        $this->commentService->createComment($request->validated());
        return redirect()->back()->with('success', 'Bình luận đã được gửi.');
    }
}
