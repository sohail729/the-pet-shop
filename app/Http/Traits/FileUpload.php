<?php
namespace App\Http\Traits;

trait FileUpload {

    public function storeFile($file, $dir = 'uploads') {
        if(!empty($file)){
            return  $file->store($dir, 'public');
        }
        return null;      
    }

}