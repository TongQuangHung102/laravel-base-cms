<?php

namespace App\Repositories;

use App\Models\User;

class ProfileRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }
}
