<?php

namespace App\Interfaces;

interface BrandRepositoryInterface 
{
    public function getBrandById($brandId);
    public function deleteBrand($brandId);
    public function createBrand(array $brandDetails);
    public function updateBrand($brandId, array $newDetails);
}