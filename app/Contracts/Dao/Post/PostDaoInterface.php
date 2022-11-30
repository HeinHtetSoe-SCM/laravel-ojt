<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    public function index();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function delete($id);
}