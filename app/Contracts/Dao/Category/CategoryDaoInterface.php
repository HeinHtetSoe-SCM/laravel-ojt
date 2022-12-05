<?php

namespace App\Contracts\Dao\Category;

interface CategoryDaoInterface
{
    public function index();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function delete($id);
}