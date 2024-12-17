<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController
{
    public function register(Request $request)
    {
        // Thông báo lỗi bằng tiếng Việt
        $messages = [
            'first_name.required' => 'Tên không được để trống.',
            'first_name.string' => 'Tên phải là chuỗi ký tự.',
            'first_name.max' => 'Tên không được vượt quá 255 ký tự.',
            'last_name.required' => 'Họ không được để trống.',
            'last_name.string' => 'Họ phải là chuỗi ký tự.',
            'last_name.max' => 'Họ không được vượt quá 255 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'cccd.required' => 'CCCD không được để trống.',
            'cccd.unique' => 'CCCD đã tồn tại.',
            'cccd.size' => 'CCCD phải có đúng 12 ký tự.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'phone.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 11 ký tự.',
            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ];

        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'cccd' => 'required|string|unique:users,cccd|size:12',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                ],
                'phone' => 'nullable|string|min:10|max:11',
                'address' => 'nullable|string|max:255',
            ], $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'cccd' => $request->cccd,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => 0, 
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Đăng ký tài khoản thành công.',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi khi tạo tài khoản.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
