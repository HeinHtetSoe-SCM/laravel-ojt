<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;

class PostService implements PostServiceInterface
{
    private $postDao;

    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    public function index()
    {
        return $this->postDao->index();
    }

    public function store($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        
        return $this->postDao->store($request);
    }

    public function edit($id)
    {
        return $this->postDao->edit($id);
    }

    public function update($request, $id)
    {
        return $this->postDao->update($request, $id);
    }

    public function delete($id)
    {
        return $this->postDao->delete($id);
    }
}