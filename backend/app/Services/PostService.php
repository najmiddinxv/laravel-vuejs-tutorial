<?php

namespace App\Services;

use App\Contracts\PostServiceContract;
use App\Http\Filters\V1\PostFilter;
use App\Models\Content\Post;

class PostService implements PostServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService
    ){}

    public function index(PostFilter $filter)
    {
        $posts = Post::with('category', 'tags')->getByFilter($filter);
        return $posts;
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }
        $post = Post::create($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }
        return $post;
    }

    public function show(int $id):Post
    {
        return Post::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $post = Post::find($id);

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($post->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $post->update($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

        return $post;
    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        $this->fileUploadService->resizedImageDelete($post->main_image);
        return $post->delete();
    }
}
