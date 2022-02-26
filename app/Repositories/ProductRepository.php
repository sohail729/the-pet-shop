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

    public function getProducts($options) 
    {
        $query =  $this->model->query();
        $query->with(['category','brand']);

        if(isset($options->title)){
            $query->where('title','LIKE','%'.$options->title.'%');
        }

        if(isset($options->category)){
            $query->where('category_uuid', $options->category);
        }
        
        if(isset($options->brand)){
            $query->whereJsonContains('metadata',['brand' =>  $options->brand]);
        }

        if(isset($options->price)){
            $query->where('price', $options->price);
        }

        if(isset($options->limit) && isset($options->page)){
           return $query->paginate($options->limit, ['*'], 'page', $options->page);
        }

        return $query->paginate(20);

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
