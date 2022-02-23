<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends APIBaseController
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface) {
        $this->userRepository = $userRepositoryInterface;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $response = $this->userRepository->createUser($request->validated());
        if($response){
             return $this->responseJson(200, 'User created successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $response =  $this->userRepository->getUserById($request->uuid);
        if(!$response->isempty()){
            return $this->responseJson(200, 'User fetched successfully!', $response);
        }
        return $this->responseJson(404, 'User not found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $response = $this->userRepository->updateUser($request->uuid ,$request->validated());
        if($response){
             return $this->responseJson(200, 'User updated successfully!');
        }
        return $this->responseJson(422, 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = $this->userRepository->deleteUser($request->uuid);
        if($response){
            return $this->responseJson(200, 'User deleted successfully!');
        }
        return $this->responseJson(404, 'User not found!');
    }
}
