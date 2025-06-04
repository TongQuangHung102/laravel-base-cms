<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findOrFail($id)
    {
        return User::findOrFail($id);
    }

    public function update(User $user, array $data)
    {
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->gender = $data['gender'] ?? null;
        $user->birthdate = $data['birthdate'] ?? null;
        $user->address = $data['address'] ?? null;
        $user->slogan = $data['slogan'] ?? null;
        
        // Nếu có mật khẩu (nếu bạn bật field này sau)
        // if (!empty($data['password'])) {
        //     $user->password = Hash::make($data['password']);
        // }

        $user->save();
    }
}
