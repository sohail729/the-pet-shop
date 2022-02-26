<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    protected $model;

    public function __construct(Category $user) {
        $this->model = $user;
    }

    public function getCategories() 
    {
        return $this->model->all();
    }

    public function getCategoryById($uuid) 
    {
        return $this->model->whereUuid($uuid)->get();
    }

    public function deleteCategory($uuid) 
    {
        return $this->model->whereUuid($uuid)->delete();
    }

    public function createCategory(array $data) 
    {
        return $this->model->create($data);
    }

    public function updateCategory($uuid, array $data) 
    {
        return $this->model->whereUuid($uuid)->update($data);  
    }
    
}
