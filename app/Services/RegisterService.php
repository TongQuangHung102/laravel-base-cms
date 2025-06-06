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
        // Mã hóa mật khẩu
        $data['password'] = Hash::make($data['password']);
        $user = $this->registerRepository->create($data);
        // Tìm role mặc định có tên là 'user' trong bảng roles.
        $defaultRole = Role::where('name', 'user')->first();

        if ($defaultRole) {
            // Gắn role mặc định cho user bằng cách thêm 1 bản ghi vào bảng trung gian user_roles.
            $user->roles()->attach($defaultRole->id);
            // Hoặc $user->roles()->syncWithoutDetaching([$defaultRole->id]);
            // syncWithoutDetaching dùng khi bạn muốn gắn thêm role mà không làm mất các role cũ nếu có.
        } else {
            Log::error('Không tìm thấy vai trò mặc định "u  ser" trong quá trình đăng ký người dùng.');
        }
        return $user;
    }
}
