<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);


        $login_type = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([
            $login_type => $credentials['login'],
            'password' => $credentials['password'],
            'deleted_at' => null,
        ])) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không đúng hoặc tài khoản đã bị xóa.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
