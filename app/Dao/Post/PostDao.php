<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Category;

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
     * get category data to create post
     * 
     * @return object
     */
    public function getCategories() {
        return Category::all();
    }

    /**
     * Store post for post page
     * @param object $request
     * @return object
     */
    public function store($request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        $post->categories()->attach($request->categories);
        return $post;
    }

    /**
     * Edit post for post page
     * @param int $id
     * @return object
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $oldCategoryIds = $post->categories->pluck('id')->toArray();
        return [
            "post" => $post, 
            "categories" => $categories,
            "oldCategoryIds" => $oldCategoryIds
        ];
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
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        $post->categories()->detach();
        $post->categories()->attach($request->categories);
        return $post;
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
