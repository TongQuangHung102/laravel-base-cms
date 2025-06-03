<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    protected $loginService;
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $user = $this->loginService->attemptLogin($credentials);
        if ($user) {
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/listuser');
            } elseif ($user->role === 'user') {
                return redirect()->intended('/page');
            }
            return redirect()->intended('/');
        }
        return redirect()->intended('/');
    }

    public function logout()
    {
        $this->loginService->logout();
        return redirect('/');
    }
}
