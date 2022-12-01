<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    /**
     * Get post for post page
     * 
     * @return object
     */
    public function index()
    {   
        return Post::latest()->paginate(5);
    }

    /**
     * Store post for post page
     * @param object $request
     * @return object
     */
    public function store($request)
    {
        return Post::create($request->all());
    }

    /**
     * Edit post for post page
     * @param int $id
     * @return object
     */
    public function edit($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update post for post page
     * @param object $request
     * @param int $id
     * @return object
     */
    public function update($request, $id)
    {
        $post = Post::findOrFail($id);
        return $post->update($request->all());
    }

    /**
     * Delete post for post page
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}
