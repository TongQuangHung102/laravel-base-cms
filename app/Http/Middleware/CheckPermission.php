<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */ 
        $user = Auth::user();


        if (!$user->hasPermission($permission)) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }

        return $next($request);
    }
}
