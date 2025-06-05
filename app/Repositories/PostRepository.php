<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    protected $post;


    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function findOrFail(int $id): Post
    {
        return $this->post->findOrFail($id);
    }

    public function update(Post $post, array $data): bool
    {
        return $post->update($data);
    }
    public function create(array $data): Post
    {
        return $this->post->create($data);
    }
}
