<?php

namespace App\Repositories;

use App\Interfaces\FileRepositoryInterface;
use App\Models\File;

class FileRepository implements FileRepositoryInterface 
{
    protected $model;

    public function __construct(File $user) {
        $this->model = $user;
    }

    public function getFileById($uuid) 
    {
        return $this->model->whereUuid($uuid)->get();
    }

    public function createFile(array $data) 
    {
        return $this->model->create($data);
    }
    
}
