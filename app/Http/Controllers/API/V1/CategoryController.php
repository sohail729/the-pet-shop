<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends APIBaseController
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface) {
        $this->categoryRepository = $categoryRepositoryInterface;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->categoryRepository->getCategories();
        if(!$response->isempty()){
            return $this->responseJson(200, 'Categories fetched successfully!', $response);
        }
        return $this->responseJson(422, 'Something went wrong!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $response = $this->categoryRepository->createCategory($request->validated());
        if($response){
             return $this->responseJson(200, 'Category created successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $response = $this->categoryRepository->getCategoryById($uuid);
        if(!$response->isempty()){
            return $this->responseJson(200, 'Category fetched successfully!', $response);            
        }
        return $this->responseJson(404, 'No record found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $uuid)
    {
        $response = $this->categoryRepository->updateCategory($uuid ,$request->validated());
        if($response){
            return $this->responseJson(200, 'Category updated successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $response = $this->categoryRepository->deleteCategory($uuid);
        if($response){
            return $this->responseJson(200, 'Category deleted successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
}
