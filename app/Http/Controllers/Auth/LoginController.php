<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LoginService;
use App\Models\User;
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
            $loggedInUser = Auth::user(); 
            if ($loggedInUser) {
                if ($loggedInUser->hasRole('admin')) { 
                    return redirect()->intended('/admin/listuser');
                } 
                elseif ($loggedInUser->hasRole('user')) { 
                    return redirect()->intended('/page');
                }
                return redirect()->intended('/');
            }
        }
        return redirect()->back()->withErrors(['credentials' => 'Thông tin đăng nhập không chính xác.']);
    }

    public function logout()
    {
        $this->loginService->logout();
        return redirect('/');
    }
}
