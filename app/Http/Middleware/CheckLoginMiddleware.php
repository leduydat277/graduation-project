<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $action
     * @return mixed
     */
    public function handle($request, Closure $next, $action = null)
    {
        // Kiểm tra hành động được truyền vào middleware
        switch ($action) {
            case 'guest-only':
                // Nếu đã đăng nhập thì không cho phép truy cập
                if (Auth::check()) {
                    return redirect()->route('client.home')->with('error', 'Bạn đã đăng nhập.');
                }
                break;

            case 'auth-only':
                // Nếu chưa đăng nhập thì không cho phép truy cập
                if (!Auth::check()) {
                    return redirect()->route('client.login')->with('error', 'Bạn cần đăng nhập để truy cập.');
                }
                break;
        }

        // Tiếp tục truy cập route
        return $next($request);
    }
}
