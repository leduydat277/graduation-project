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
        switch ($action) {
            case 'guest-only':
                if (Auth::check()) {
                    return redirect()->route('client.home')->with('error', 'Bạn đã đăng nhập.');
                }
                break;

            case 'auth-only':
                if (!Auth::check()) {
                    return redirect()->route('client.login')->with('error', 'Bạn cần đăng nhập để truy cập.');
                }
                break;
        }

        return $next($request);
    }
}
