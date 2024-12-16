<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MailController;
use App\Mail\SendMail;
use App\Mail\ForgotPassword;
use App\Models\email;
use App\Models\token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    private $messages;
    
    public function __construct(){
        $this->messages = [
            'name.required' => 'Tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
        ];
    }

    public function loginUI(){
        return view("client.authentication.login");
    }
    public function registerUI(){
        return view("client.authentication.register");
    }
    
}
