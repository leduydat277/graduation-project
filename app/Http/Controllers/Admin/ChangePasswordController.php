<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.changePassword.index');
    }
    public function ChangePassword(Request $request)
    {
        $user = User::find(1);
        if ($user) {
            $validated = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
                'new_password_confirmation' => 'required|',
            ]);
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
                $user->update();
                return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công');
            } else {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
            }
        } else {
            return redirect()->route('')->with('error', 'Chưa Login hoặc không phải Administrator');
        }
    }
}
