<?php

namespace App\Dao\Post;

use DB;
use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    public function index()
    {   
        return Post::all();
    }

    public function store($request)
    {
        return Post::create($request->all());
    }

    public function edit($id)
    {
        return Post::findOrFail($id);
    }

    public function update($request, $id)
    {
        $post = Post::findOrFail($id);
        return $post->update($request->all());
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}