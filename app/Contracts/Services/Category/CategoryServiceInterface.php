<?php

namespace App\Contracts\Services\Category;

interface CategoryServiceInterface
{
    public function index();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function delete($id);
}