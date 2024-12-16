<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// class DashBoardController extends Controller
// {
//     // Hiển thị form đăng ký

//     const VIEW_PATH = 'admin.auth.';

//     public function showRegisterForm()
//     {
//         return view(self::VIEW_PATH . 'register');
//     }

//     // Xử lý đăng ký
//     public function register(Request $request)
//     {
//         // Xác thực dữ liệu đầu vào
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//         ]);

//         // Tạo user mới
//         User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'cccd' => '040204008179',
//             'role' => '0',
//             'phone' => '0987654321',
//         ]);

//         return redirect()->route('admin.login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
//     }

//     // Hiển thị form đăng nhập
//     public function showLoginForm()
//     {
//         return view(self::VIEW_PATH . 'login');
//     }

//     // Xử lý đăng nhập
//     public function login(Request $request)
//     {
//         // Xác thực dữ liệu đầu vào
//         $request->validate([
//             'email' => 'required|string|email',
//             'password' => 'required|string',
//         ]);
    
//         // Thử đăng nhập
//         if (Auth::attempt($request->only('email', 'password'))) {
//             // Lấy thông tin user đã đăng nhập
//             $user = Auth::user();
    
//             // Trả về thông báo thành công kèm theo dữ liệu người dùng
//             return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công.');
//         }
//     }
//     // Xử lý đăng xuất
//     public function logout()
//     {
//         Auth::logout();
//         return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công.');
//     }
// }
