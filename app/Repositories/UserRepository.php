<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    protected $model;

    public function __construct(User $user) {
        $this->model = $user;
    }

    public function getUserById($uuid) 
    {
        return $this->model->whereUuid($uuid)->get();
    }

    public function deleteUser($uuid) 
    {
        return $this->model->whereUuid($uuid)->delete();
    }

    public function createUser(array $data) 
    {
        return $this->model->create($data);
    }

    public function updateUser($uuid, array $data) 
    {
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        return $this->model->whereUuid($uuid)->update($data);  
    
    }

}
