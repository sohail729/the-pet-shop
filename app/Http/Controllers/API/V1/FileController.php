<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Traits\FileUpload;
use App\Interfaces\FileRepositoryInterface;
use Illuminate\Http\Request;

class FileController extends APIBaseController
{
    use FileUpload;

    private $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepositoryInterface) {
        $this->fileRepository = $fileRepositoryInterface;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $file =  $request->file('file');
        $data['name'] = $file->getClientOriginalName();
        $data['path'] = $this->storeFile($file); // returns file path
        $data['size'] = $file->getSize();
        $data['type'] = $file->getClientMimeType();
        $response = $this->fileRepository->createFile($data);
        if($response){
             return $this->responseJson(200, 'File created successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $response = $this->fileRepository->getFileById($uuid);
        if(!$response->isempty()){
            return $this->responseJson(200, 'File fetched successfully!', $response);            
        }
        return $this->responseJson(404, 'No record found!');
    }
}
