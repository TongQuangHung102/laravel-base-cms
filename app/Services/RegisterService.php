<?php

namespace App\Services;

use App\Repositories\RegisterRepository;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        unset($data['role']);
        $user = $this->registerRepository->create($data);
        $defaultRole = Role::where('name', 'User')->first();

        if ($defaultRole) {
            $user->roles()->attach($defaultRole->id);
            // Hoặc $user->roles()->syncWithoutDetaching([$defaultRole->id]);
        } else {
            Log::error('Default role "user" not found during user registration.');
        }
        return $user;
    }
}
