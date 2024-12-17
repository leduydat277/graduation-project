<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public $timestamps = false;

    public $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'cccd',
        'password',
        'phone',
        'address',
        'role'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function registerUser()
    {
        // Dữ liệu cần thêm vào cơ sở dữ liệu
        $userData = [
            'name' => 'Cao Anh J',
            'email' => 'example@example.com',
            'CCCD' => '012345678901',
            'password' => Hash::make('1'), // Mã hóa mật khẩu
            'image' => 'image10.jpg',
            'phone' => '0934222334',
            'address' => 'Bắc Ninh',
            'role' => 1, // 1: Admin
        ];

        // Thêm user vào database
        try {
            $user = User::create($userData);
            return redirect()->route('admin.login')->with('success', 'Tạo user thành công.');
        } catch (\Exception $e) {
            return "Lỗi khi tạo user: " . $e->getMessage();
        }
    }
}
