<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{

    public function getUserById($userId);

    public function deleteUser($userId);

    public function createUser(array $data);

    public function updateUser($userId, array $data);

}