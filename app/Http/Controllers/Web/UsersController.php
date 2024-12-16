<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->messages = [
            'name.required' => 'Tên không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'address.required' => 'Địa chỉ không được để trống.',
            'role.required' => 'Chức vụ không được để trống.',
            'status_id.required' => 'Chức vụ không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password_old.required' => 'Mật khẩu cũ không được để trống.',
            'password_old.min' => 'Mật khẩu cũ phải có ít nhất :min ký tự.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'confirm_password_new.required' => 'Mật khẩu mới không được để trống.',
            'confirm_password_new.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
            'image.mimes' => 'Vui lòng chọn file có đuôi jpeg,jpg,png.',
        ];
    }
    public function getUser()
    {
        $usersDefault = Auth::user();
        $data =  User::where("id", "=", $usersDefault->id)->first();
        $data->image = asset('storage/' . $data->image);
        return view("client.profile", compact("data"));
    }
    public function updateProficeUser($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "address" => "required|string",
            "phone" => "required",
            "email" => "required|string|email",
            'image' => 'image|mimes:jpeg,jpg,png'
        ], $this->messages);
        if ($validator->fails()) {
            return redirect()->back() // Quay lại trang trước đó (addUI)
                ->withErrors($validator) // Gửi lỗi về view
                ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
        }
        $password = request("password");
        $name = request("name");
        $email = request("email");
        $image = "";
        $address = request("address");
        $phone = request("phone");

        $dataUsers = User::where("email", $email)->where("id", "!=", $id)->first();
        $dataUsersOld = User::where("id", "=", $id)->first();
        if ($dataUsers) {
            return redirect()->back() // Quay lại trang trước đó (addUI)
                ->withErrors(["email" => "Email đã được sử dụng."]) // Gửi lỗi về view
                ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
        }
        // duyệt qua từng file và lưu trữ
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            // Validate each file
            if (!$files->isValid()) {
                return redirect()->back()
                    ->withErrors(["image" => "File không hợp lệ, vui lòng thử lại"])
                    ->withInput();
            }

            if (Storage::disk('public')->exists($dataUsersOld->image)) {
                Storage::disk("public")->delete($dataUsersOld->image);
            }

            // Store the file with a unique name
            $image = $files->store('uploads', 'public');
        } else {
            $image = $dataUsersOld->image;
        }

        $dataUpdate = [
            "name" => $name,
            "email" => $email,
            "image" => $image,
            "address" => $address,
            "phone" => $phone,
        ];

        if (!empty($password)) {
            $dataUpdate["password"] =  bcrypt($password);
        }
        User::where("id", $id)->update($dataUpdate);
        return redirect()->route('account')->with('success', 'Cập nhật tài khoản thành công');
    }

    public function updatePasswordUserUI()
    {
        $data = Auth::user();
        return view("client.confirmPassword", compact("data"));
    }
    public function updatePasswordUser($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            "password_old" => "required|string|min:8", // Yêu cầu mật khẩu cũ phải nhập
            "password" => "required|string|min:8|different:password_old", // Mật khẩu mới phải khác mật khẩu cũ
            "confirm_password_new" => "required|string|same:password", // Mật khẩu xác nhận phải khớp với mật khẩu mới
        ], $this->messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $passwordOld = $request->input('password_old');
        $passwordNew = $request->input('password');

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()
                ->withErrors(["password_old" => "Không tìm thấy tài khoản của bạn. Vui lòng đăng nhập lại."])
                ->withInput();
        }

        // Kiểm tra mật khẩu cũ có khớp không
        if (!Hash::check($passwordOld, $user->password)) {
            return redirect()->back()
                ->withErrors(["password_old" => "Mật khẩu cũ không chính xác."])
                ->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = bcrypt($passwordNew);
        $user->save();

        return redirect()->route('updatePasswordUserUI')->with('success', 'Cập nhật mật khẩu thành công.');
    }
}
