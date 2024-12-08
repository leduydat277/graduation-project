<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
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
            'role.required' => 'Chức vụ không được để trống.',
            'status_id.required' => 'Chức vụ không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
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
    public function getId($id){
        $data = User::select("name", "email", "image", "role")->first();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có dữ liệu'], 404);
        }
        return response()->json($data);
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
            return redirect()->back() // Quay lại trang trước đó (addUI)
                ->withErrors($validator) // Gửi lỗi về view
                ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
        }
    
        // Thực hiện các bước xử lý còn lại nếu validate thành công
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
            return redirect()->back() // Quay lại trang trước đó (addUI)
            ->withErrors(["email" => "Không tìm thấy tài khoản"]) // Gửi lỗi về view
            ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
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
            return redirect()->back() // Quay lại trang trước đó (addUI)
                ->withErrors($validator) // Gửi lỗi về view
                ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
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