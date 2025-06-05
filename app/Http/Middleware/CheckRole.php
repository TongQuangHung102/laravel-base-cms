<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    // $next: callback để chuyển tiếp xử lý sang middleware tiếp theo hoặc controller.
    // ...$roles: cú pháp PHP "variadic", dùng để truyền nhiều giá trị role một cách linh hoạt (role:admin, role:admin,manager, v.v.).
    public function handle($request, Closure $next, ...$roles)
    {
        // Kiểm tra người dùng có đăng nhập hay không (Auth::check()).
        if (!Auth::check()) {
            return redirect('/login');
        }
        // Lấy thông tin user hiện tại qua Auth::user().
        $user = Auth::user();
        // So sánh role của user có nằm trong danh sách $roles không.
        // 1.Nếu không, trả về lỗi 403 Forbidden.
        // 2.Nếu có, tiếp tục xử lý request ($next($request)).
        if (!in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập.');
        }
        return $next($request);
    }
}
