<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface 
{
    protected $model;

    public function __construct(Product $user) {
        $this->model = $user;
    }

    public function getProductById($uuid) 
    {
        return $this->model->whereUuid($uuid)->get();
    }

    public function deleteProduct($uuid) 
    {
        return $this->model->whereUuid($uuid)->delete();
    }

    public function createProduct(array $data) 
    {
        $data['metadata'] = json_encode(['image' => $data['image'], 'brand' => $data['brand']]);
        return $this->model->create($data);
    }

    public function updateProduct($uuid, array $data) 
    {
        return $this->model->whereUuid($uuid)->update($data);  
    }
    
}
