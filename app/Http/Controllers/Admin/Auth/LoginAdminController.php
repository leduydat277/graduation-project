<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdminController
{
    // Đường dẫn tới các view liên quan đến auth
    const VIEW_PATH = 'admin.auth.';

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        // Kiểm tra nếu admin đã đăng nhập, chuyển hướng tới dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view(self::VIEW_PATH . 'login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        // Thử đăng nhập với 'remember' option
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Kiểm tra role để đảm bảo là admin
            $user = Auth::user();
            if ($user->role !== 1) { // 1: Admin
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Bạn không có quyền truy cập trang này.',
                ]);
            }
    
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công.');
        }
    
        // Xử lý khi đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput();
    }
}