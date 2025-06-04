<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->update($user, $data);
    }
}
