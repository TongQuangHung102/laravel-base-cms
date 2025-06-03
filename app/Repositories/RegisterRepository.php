<?php

namespace App\Repositories;

use App\Models\User;

class RegisterRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }


    public function create(array $data): User
    {
        return $this->model->create($data);
    }
}
