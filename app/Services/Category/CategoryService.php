<?php

namespace App\Services\Category;

use App\Contracts\Dao\Category\CategoryDaoInterface;
use App\Contracts\Services\Category\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    private $categoryDao;

    public function __construct(CategoryDaoInterface $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    public function index()
    {
        return $this->categoryDao->index();
    }

    public function store($request)
    {
        return $this->categoryDao->store($request);
    }

    public function edit($id)
    {
        return $this->categoryDao->edit($id);
    }

    public function update($request, $id)
    {
        return $this->categoryDao->update($request, $id);
    }

    public function delete($id)
    {
        return $this->categoryDao->delete($id);
    }
}