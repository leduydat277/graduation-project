<?php

namespace App\Http\Controllers\Auth;

use App\Mail\LoginNotificationMail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return view('client.auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            Mail::to($user->email)->send(new LoginNotificationMail($user));

            return redirect()->route('client.home')->with('success', 'Đăng nhập thành công! Kiểm tra email của bạn.');
        }

        // Đăng nhập thất bại
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])->withInput();
    }


    /**
     * Handle an authentication attempt.
     */
    public function showRegisterForm()
    {
        return view('client.auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits_between:10,15',
            'cccd' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'last_name.required' => 'Họ không được để trống.',
            'first_name.required' => 'Tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.numeric' => 'Số điện thoại phải là số.',
            'phone.digits_between' => 'Số điện thoại phải có từ 10 đến 15 chữ số.',
            'cccd.max' => 'Số CCCD không được vượt quá 50 ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        User::create([
            'name' => "{$validatedData['last_name']} {$validatedData['first_name']}",
            'last_name' => $validatedData['last_name'],
            'first_name' => $validatedData['first_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'cccd' => $validatedData['cccd'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'role' => 0,
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('client.login')->with('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');
    }


    public function forgotPassword()
    {
        return view('client.auth.forgotpassword');
    }

    public function sendMailForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);

        $user = User::where('email', $request->email)->first();

        $token = Str::random(64);

        DB::table('tokens')->where('user_id', $user->id)->delete();

        DB::table('tokens')->insert([
            'user_id' => $user->id,
            'value' => $token,
            'expiry_time' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->queue(new ResetPasswordMail($token));

        return redirect()->route('client.forgotPassword')->with('success', 'Email khôi phục mật khẩu đã được gửi. Vui lòng kiểm tra email của bạn.');
    }


    public function resetPasswordView(Request $request)
    {
        $token = $request->get('token');
        $tokenData = DB::table('tokens')->where('value', $token)->first();

        if (!$tokenData || $tokenData->expiry_time < now()) {
            return abort(404, 'Token không hợp lệ hoặc đã hết hạn.');
        }

        return view('client.Auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        // Kiểm tra token
        $tokenData = DB::table('tokens')->where('value', $validatedData['token'])->first();

        if (!$tokenData || $tokenData->expiry_time < now()) {
            return redirect()->back()->withErrors(['token' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        // Lấy thông tin người dùng
        $user = User::find($tokenData->user_id);
        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'Không tìm thấy người dùng.']);
        }

        // Cập nhật mật khẩu
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        // Xóa token sau khi sử dụng
        DB::table('tokens')->where('value', $validatedData['token'])->delete();

        // Chuyển hướng đến trang đăng nhập với thông báo thành công
        return redirect()->route('client.login')->with('success', 'Mật khẩu đã được đặt lại thành công!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.home');
    }
}
