<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $postDao;

    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Get posts for post page
     * 
     * @return object
     */
    public function index()
    {
        return $this->postDao->index();
    }

    /**
     * Store post for post page
     * @param object $request
     * @return object
     */
    public function store($request)
    {   
        return $this->postDao->store($request);
    }

    /**
     * Edit post for post page
     * @param int $id
     * @return object
     */
    public function edit($id)
    {
        return $this->postDao->edit($id);
    }

    /**
     * Update post for post page
     * @param object $request
     * @param int $id
     * @return object
     */
    public function update($request, $id)
    {
        return $this->postDao->update($request, $id);
    }

    /**
     * Delete post for post page
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        return $this->postDao->delete($id);
    }
}
