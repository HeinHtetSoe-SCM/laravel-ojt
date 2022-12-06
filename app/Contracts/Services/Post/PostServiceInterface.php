<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    /**
    * Get posts for post page
    * 
    * @return object
    */
    public function index();

    public function getCategories();
    /**
    * Post store for post page
    * @param object $request
    * @return object
    */
    public function store($request);

    /**
    * Post edit for post page
    * @param int $id
    * @return object
    */
    public function edit($id);

    /**
    * Post update for post page
    * @param object $request
    * @param int $id
    * @return object
    */
    public function update($request, $id);

    /**
    * Post delete for post page
    * @param int $id
    * @return object
    */
    public function delete($id);
}
