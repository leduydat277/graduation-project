<?php

namespace App\Http\Controllers\Admin;

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
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'current_password' => 'required|current_password',
                'new_password' => 'required|min:8|confirmed',
                'new_password_confirmation' => 'required|',
            ]);

            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
            }

            $user = Auth::user();
            dd($user);
            $user->password = bcrypt($request->new_password);
            $user->save();


            return redirect()->route('')->with('success', 'Mật khẩu đã được thay đổi thành công');
        } else {
            echo "chưa login";
        }
    }
}
