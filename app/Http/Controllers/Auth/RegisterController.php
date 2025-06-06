<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }


    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();
        $user = $this->registerService->registerUser($userData);

        // Tùy chọn: Đăng nhập người dùng ngay sau khi đăng ký
        // \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('register')->with('success', 'Đăng ký thành công!');
    }
}
