<?php

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface 
{
    protected $model;

    public function __construct(Brand $user) {
        $this->model = $user;
    }

    public function getBrandById($uuid) 
    {
        return $this->model->whereUuid($uuid)->get();
    }

    public function deleteBrand($uuid) 
    {
        return $this->model->whereUuid($uuid)->delete();
    }

    public function createBrand(array $data) 
    {
        return $this->model->create($data);
    }

    public function updateBrand($uuid, array $data) 
    {
        return $this->model->whereUuid($uuid)->update($data);  
    }
    
}
