<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // if (!auth()->check()) {
        //     return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để bình luận.');
        // }

        // $request->validate([
        //     'post_id' => 'required|exists:posts,id',
        //     'content' => 'required|string|max:1000',
        // ]);

        // Comment::create([
        //     'user_id' => auth()->id(),
        //     'post_id' => $request->post_id,
        //     'content' => $request->content,
        // ]);

        // return redirect()->back()->with('success', 'Bình luận đã được gửi.');
    }
}
