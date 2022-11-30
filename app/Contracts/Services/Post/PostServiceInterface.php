<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    public function index();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function delete($id);
}