<?php

namespace App\Services;

use App\Repositories\RegisterRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }


    public function registerUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'User';

        return $this->registerRepository->create($data);
    }
}
