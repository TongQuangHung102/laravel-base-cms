<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginService
{
    public function __construct() {}

    public function attemptLogin(array $credentials): ?User
    {
        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $authCredentials = [
            $loginType => $credentials['login'],
            'password' => $credentials['password'],
            'deleted_at' => null,
        ];
        if (Auth::attempt($authCredentials)) {
            return Auth::user();
        }
        throw ValidationException::withMessages([
            'login' => 'Thông tin đăng nhập không đúng hoặc tài khoản đã bị xóa.',
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
