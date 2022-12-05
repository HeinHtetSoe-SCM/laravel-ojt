<?php

namespace App\Dao\Category;

use App\Models\Category;
use App\Contracts\Dao\Category\CategoryDaoInterface;
use App\Models\Post;

class CategoryDao implements CategoryDaoInterface
{
    public function index()
    {
        // $category = Category::find(1);
        // dd($category->posts);
        // foreach ($category->posts as $post) {
        //     dd($post->pivot->post_id);
        //     $post = Post::find($post->pivot->post_id);
        //     dd($post->title);
        // }
        return Category::latest()->paginate(5);
    }

    public function store($request)
    {
        return Category::create($request->all());
    }

    public function edit($id)
    {
        return Category::findOrFail($id);
    }

    public function update($request, $id)
    {
        $category = Category::findOrFail($id);

        return $category->update($request->all());
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        return $category->delete();
    }
}