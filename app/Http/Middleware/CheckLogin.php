<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Middleware;

class CheckLogin extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và đang cố truy cập trang đăng nhập hoặc đăng ký
        if (Auth::check() && ($request->routeIs('admin.login') || $request->routeIs('admin.register'))) {
            // Chuyển hướng người dùng đã đăng nhập về trang trước đó (hoặc về trang chủ admin)
            return redirect()->route('admin.dashboard')->with('message', 'Bạn đã đăng nhập.');
        }

        // Kiểm tra nếu người dùng chưa đăng nhập và đang cố truy cập trang đặt phòng
        if (!Auth::check() && $request->routeIs('booking')) {
            // Chuyển hướng người dùng chưa đăng nhập đến trang đăng nhập
            return redirect()->route('admin.login')->with('message', 'Vui lòng đăng nhập để tiếp tục.');
        }

        // Tiếp tục xử lý request nếu không thuộc các điều kiện trên
        return $next($request);
    }
}
