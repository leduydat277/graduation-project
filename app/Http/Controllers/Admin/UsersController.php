<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use App\Models\admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersController extends RoutingController
{
    private $messages;
    const VIEW_PATH = "admin.user.";
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

    public function index(Request $request){
        $query = User::query();
        $email = $request->input("email");
        if($email){
            $query->where('email', $email);
        }
        $data = $query->get();
        $data = $data->map(function ($item) {
            return [
                "id" => $item->id,
                "name" => $item->name,
                "email" => $item->email,
                "image" => asset('storage/' .$item->image),
                "role" => $item->role,
            ];
        });
        return view(self::VIEW_PATH . __FUNCTION__, compact('data'));
    }

    public function addUI(){
        return view(self::VIEW_PATH."create");
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email",
            "password" => "required|string|min:8",
            "role" => "required",
            "status_id" => "required",
            'image' => 'image|mimes:jpeg,jpg,png'
        ], $this->messages);
        
        if ($validator->fails()) {
            return redirect()->back() 
                ->withErrors($validator) 
                ->withInput(); 
        }

        $password = $request->input("password");
        $name = $request->input("name");
        $email = $request->input("email");
        $role = $request->input("role");
        $statusId = $request->input("status_id");
    
        $image = "";
        $dataUsers = User::where("email", $email)->first();
        if ($dataUsers) {
            return redirect()->back()
                ->withErrors(["email" => "Email đã được sử dụng."])
                ->withInput();
        }
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (!$file->isValid()) {
                return redirect()->back()
                    ->withErrors(["image" => "File không hợp lệ, vui lòng thử lại"])
                    ->withInput();
            }
    
            $image = $file->store('uploads', 'public');
        }
    
        User::create([
            "name" => $name,
            "email" => $email,
            "password" => bcrypt($password),
            "image" => $image,
            "role" => $role,
            "cccd" => 1
        ]);
    
        return redirect()->route('user.addUI')->with('success', 'Thêm tài khoản thành công.');
    }

    public function editUI($id){
        $data = User::find($id);
        
        if (!$data) {
            return redirect()->back() 
            ->withErrors(["email" => "Không tìm thấy tài khoản"])
            ->withInput();
        }
        $data["image"] = asset('storage/' .$data["image"]);
        return view(self::VIEW_PATH."edit", compact("data"));
    }
    
    public function edit($id, Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email",
            "password" => "nullable|string|min:8",
            "role" => "required",
            'image' => 'image|mimes:jpeg,jpg,png'
        ], $this->messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) 
                ->withInput(); 
        }
        $password = request("password");
        $name = request("name");
        $email = request("email");
        $role = request("role");
        $image = "";
        $statusId = request("status_id");

        $dataUsers = User::where("email", $email)->where("id", "!=", $id)->first();
        $dataUsersOld = User::where("id", "=", $id)->first();
        if ($dataUsers) {
            return redirect()->back()
            ->withErrors(["email" => "Email đã được sử dụng."]) 
            ->withInput();
        }

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            if (!$files->isValid()) {
                return redirect()->back()
                    ->withErrors(["image" => "File không hợp lệ, vui lòng thử lại"])
                    ->withInput();
            }

            if (Storage::disk('public')->exists($dataUsersOld->image)) {
                Storage::disk("public")->delete($dataUsersOld->image);
            }
            $image = $files->store('uploads', 'public');
        }else{
            $image = $dataUsersOld->image;
        }

        $dataUpdate =[
            "name" => $name,
            "email" => $email,
            "image" => $image,
            "role" => $role,
        ];

        if(!empty($password)){
            $dataUpdate["password"] =  bcrypt($password);
        }

        User::where("id", $id)->update($dataUpdate);
        return redirect()->route('user.editUI', $id)->with('success', 'Cập nhật tài khoản thành công');
    }

    public function delete($id){
        User::where("id", $id)->update(["status_id"=> 2]);
        return redirect()->route('user.index', $id)->with('success', 'Vô hiệu hóa tài khoản thành công');
    }
}
