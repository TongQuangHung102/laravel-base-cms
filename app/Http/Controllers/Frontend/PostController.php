<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the pages.
     * Người dùng chưa đăng nhập cũng có thể xem trang danh sách.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $view = view('frontend.posts.index', compact('posts'));
        return response($view);
    }

    /**
     * Display the specified page.
     * Người dùng chưa đăng nhập cũng có thể xem trang chi tiết.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['comments.user'])->findOrFail($id);
        $view = view('frontend.posts.show', compact('post'));
        return response($view);
    }

    public function myPosts()
    {
        $userId = Auth::id();
        $myPosts = Post::where('user_id', $userId)->paginate(1);
        $view = view('frontend.posts.my-posts', compact('myPosts'));
        return response($view);
    }
}
