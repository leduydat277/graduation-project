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
        // Validate dữ liệu đầu vào
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Lấy thông tin từ request
        $credentials = $request->only('email', 'password');

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($credentials, $request->has('remember'))) {

            $user = Auth::user();

            // Gửi thông báo qua email
            Mail::to($user->email)->send(new LoginNotificationMail($user));
            return response()->json(['success' => 'Đăng nhập thành công!']);
        }

        // Đăng nhập thất bại
        return response()->json(['errors' => ['email' => 'Email hoặc mật khẩu không đúng.']], 422);
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
        // Validate dữ liệu đầu vào
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits_between:10,15',
            'cccd' => 'nullable|string|max:50', // Cho phép null nếu không bắt buộc
            'address' => 'nullable|string|max:255', // Cho phép null nếu không bắt buộc
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Họ và tên không được để trống.',
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

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Tạo user mới
        $user = new User();
        $user->name = $request->name; // Họ và tên đầy đủ
        $user->last_name = $request->last_name; // Họ
        $user->first_name = $request->first_name; // Tên
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->cccd = $request->cccd ?? null; // Gán giá trị null nếu không có
        $user->address = $request->address ?? null; // Gán giá trị null nếu không có
        $user->role = 0; // Mặc định là `user` nếu không nhập
        $user->password = bcrypt($request->password); // Hash mật khẩu
        $user->save();

        // Đăng nhập tự động sau khi đăng ký
        Auth::login($user);

        return response()->json(['success' => 'Đăng ký tài khoản thành công!']);
    }
    // hiển thị quên mật khẩu
    public function forgotPassword()
    {
        return view('client.auth.forgotpassword');
    }

    // Gửi email quên mật khẩu
    public function sendMailForgotPassword(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['errors' => ['email' => 'Không tìm thấy email này trong hệ thống.']], 422);
        }

        // Tạo token reset password
        $token = Str::random(64);

        // Xóa token cũ (nếu có) cho user này
        DB::table('tokens')->where('user_id', $user->id)->delete();

        // Lưu token mới vào bảng `tokens`
        DB::table('tokens')->insert([
            'user_id' => $user->id,
            'value' => $token, // Token sẽ lưu trong cột `value`
            'expiry_time' => now()->addMinutes(5)->format('Y-m-d H:i:s'), // Chuyển sang định dạng DATETIME
            // 'created_at' => now()->format('Y-m-d H:i:s'), // Chuyển sang định dạng DATETIME
            // 'updated_at' => now()->format('Y-m-d H:i:s'), // Chuyển sang định dạng DATETIME
        ]);


        // Gửi email reset password
        Mail::to($user->email)->queue(new ResetPasswordMail($token));


        return response()->json(['success' => 'Gửi email đặt lại mật khẩu thành công!']);
    }

    public function resetPasswordView(Request $request)
    {
        $token = $request->get('token');
        $tokenData = DB::table('tokens')->where('value', $token)->first();
        // dd($token, $tokenData);

        if (!$tokenData || $tokenData->expiry_time < now()) {
            return abort(404, 'Token không hợp lệ hoặc đã hết hạn.');
        }

        return view('client.Auth.reset-password', ['token' => $token]);
    }




    public function resetPassword(Request $request)
    {
        // Validate dữ liệu
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Kiểm tra token
        $tokenData = DB::table('tokens')->where('value', $request->token)->first();

        if (!$tokenData || $tokenData->expiry_time < now()) {
            return response()->json(['errors' => ['token' => 'Token không hợp lệ hoặc đã hết hạn.']], 422);
        }

        // Cập nhật mật khẩu người dùng
        $user = User::find($tokenData->user_id);
        if (!$user) {
            return response()->json(['errors' => ['user' => 'Không tìm thấy người dùng.']], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        // Xóa token sau khi sử dụng
        DB::table('tokens')->where('value', $request->token)->delete();

        return response()->json(['success' => 'Đặt lại mật khẩu thành công!']);
    }


    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.home');
    }
}
