<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController
{
    public function profile(): JsonResponse
    {
        // Lấy id của user đã đăng nhập
        $user = User::find(Auth::id());

        // dd($user);
        

        // Kiểm tra nếu không có user (người dùng chưa đăng nhập)
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 401); // 401 Unauthorized
        }

        // Dữ liệu profile của user
        $profile = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cccd' => $user->cccd,
            'phone' => $user->phone,
            'role' => $user->role == 0 ? 'User' : 'Admin',
        ];

        return response()->json([
            'success' => true,
            'data' => $profile,
        ], 200);
    }
}
