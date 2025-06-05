<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // Nếu không phải gọi API (không phải JSON), nó sẽ redirect về trang đăng nhập (/login).
        if (! $request->expectsJson()) {
            return route('login');
        }
        // Nếu là request kiểu JSON (API), không redirect mà trả về null.
        // Laravel sẽ trả về HTTP status code 401 (Unauthorized) thay vì redirect.
        return null;
    }
}
