<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function updatePost(Post $post, array $data): Post
    {
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            if ($post->thumbnail) {
                if (Storage::disk('public')->exists($post->thumbnail)) {
                    Storage::disk('public')->delete($post->thumbnail);
                }
            }
            $originalFileName = $data['thumbnail']->getClientOriginalName();
            $path = $data['thumbnail']->storeAs('thumbnails', $originalFileName, 'public');
            $data['thumbnail'] = $path;
        } else {
            unset($data['thumbnail']);
        }
        if (!$this->postRepository->update($post, $data)) {
            throw new \Exception('Có lỗi khi cập nhật bài viết.');
        }

        return $post;
    }

    public function createPost(array $data): Post
    {
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            $originalFileName = $data['thumbnail']->getClientOriginalName();
            $newFileName = $originalFileName;
            $path = $data['thumbnail']->storeAs('thumbnails', $newFileName, 'public');
            $data['thumbnail'] = $path;
        } else {
            unset($data['thumbnail']);
        }
        $post = $this->postRepository->create($data);
        if (!$post) {
            throw new \Exception('Có lỗi khi thêm bài viết.');
        }
        return $post;
    }
}
