<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Interfaces\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends APIBaseController
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepositoryInterface) {
        $this->brandRepository = $brandRepositoryInterface;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $response = $this->brandRepository->createBrand($request->validated());
        if($response){
             return $this->responseJson(200, 'Brand created successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $response = $this->brandRepository->getBrandById($uuid);
        if(!$response->isempty()){
            return $this->responseJson(200, 'Brand fetched successfully!', $response);            
        }
        return $this->responseJson(404, 'No record found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $uuid)
    {
        $response = $this->brandRepository->updateBrand($uuid ,$request->validated());
        if($response){
            return $this->responseJson(200, 'Brand updated successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $response = $this->brandRepository->deleteBrand($uuid);
        if($response){
            return $this->responseJson(200, 'Brand deleted successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
}
