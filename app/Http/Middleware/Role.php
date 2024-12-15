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

        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Bạn cần đăng nhập để truy cập.');
        }

        // Kiểm tra nếu người dùng không phải admin
        if ($user->role !== 1) { // 1: Admin
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        // Tiếp tục xử lý yêu cầu nếu hợp lệ
        return $next($request);
    }
}
