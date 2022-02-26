<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends APIBaseController
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface) {
        $this->productRepository = $productRepositoryInterface;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $response = $this->productRepository->createProduct($request->validated());
        if($response){
             return $this->responseJson(200, 'Product created successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $response = $this->productRepository->getProductById($uuid);
        if(!$response->isempty()){
            return $this->responseJson(200, 'Product fetched successfully!', $response);            
        }
        return $this->responseJson(404, 'No record found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $uuid)
    {
        $response = $this->productRepository->updateProduct($uuid ,$request->validated());
        if($response){
            return $this->responseJson(200, 'Product updated successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $response = $this->productRepository->deleteProduct($uuid);
        if($response){
            return $this->responseJson(200, 'Product deleted successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
}
