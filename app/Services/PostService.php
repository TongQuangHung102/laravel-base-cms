<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
            throw new \Exception('Failed to update post.');
        }

        return $post;
    }
}
