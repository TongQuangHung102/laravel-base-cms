<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\PostRequest;
use App\Services\PostService;

class PostController extends Controller
{

    protected $postService;


    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $view = view('frontend.posts.index', compact('posts'));
        return response($view);
    }


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
    public function myPostShow($id)
    {
        $post = Post::findOrFail($id);
        $view = view('frontend.posts.my-post-show', compact('post'));
        return response($view);
    }

    public function updatePost(PostRequest $request, $id)
    {
        try {
            /** @var \App\Models\Post $post */
            $post = Post::findOrFail($id);


            $this->postService->updatePost($post, $request->validated());


            return redirect()->route('profile.my-post-show', $post->id)
                ->with('success', 'Bài viết đã được cập nhật thành công!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->back()->withErrors(['post_not_found' => 'Bài viết không tồn tại.']);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['update_failed' => 'Có lỗi xảy ra khi cập nhật bài viết: ' . $e->getMessage()])->withInput();
        }
    }

    public function showAddForm(): View
    {
        return view('frontend.posts.add');
    }

    public function store(PostRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id(); 
            $post = $this->postService->createPost($data); 

            return redirect()->route('profile.my-post-show', $post->id) 
                ->with('success', 'Bài viết đã được tạo thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['create_failed' => 'Có lỗi xảy ra khi tạo bài viết: ' . $e->getMessage()])->withInput();
        }
    }
}
