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

    public function update(array $data, $id): User
    {
        /** @var \App\Models\User $user */
        $user = $this->userRepository->findOrFail($id);
        $roleId = null;
        if (isset($data['role_id'])) {
            $roleId = $data['role_id'];
            unset($data['role_id']);
        }
        $this->userRepository->update($user, $data);


        if ($roleId !== null) {

            $user->roles()->sync([$roleId]);
        }

        return $user;
    }
}
