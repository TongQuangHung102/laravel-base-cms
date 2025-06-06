<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles  
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login'); 
        }
        /** @var \App\Models\User $user */ 
        $user = Auth::user();
        $hasRequiredRole = false;
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                $hasRequiredRole = true;
                break; 
            }
        }
        if (!$hasRequiredRole) {
            abort(403, 'Bạn không có quyền truy cập.');
        }
        return $next($request);
    }
}
