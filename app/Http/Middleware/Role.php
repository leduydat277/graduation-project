<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {

            if ($user->role === 'admin' && !$request->is('admin*')) {
                return redirect('/admin');
            }

            if ($user->role !== 'admin' && !$request->is('home')) {
                return redirect('/dashboard');
            }
        }

        // Tiếp tục yêu cầu nếu quyền truy cập là hợp lệ
        return $next($request);
    }
}
