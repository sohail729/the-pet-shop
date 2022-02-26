<?php

namespace App\Interfaces;

interface FileRepositoryInterface 
{
    public function getFileById($fileId);
    public function createFile(array $fileDetails);
}