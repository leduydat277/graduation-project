<?php

namespace App\Models\Admin;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Tên bảng trong CSDL (tùy chọn)
    protected $table = 'reviews';

    // Các trường có thể được gán giá trị hàng loạt
    protected $fillable = [
        'user_id',
        'room_id',
        'comment',
        'rating',
        'created_at',
        'updated_at'
    ];

    // Định nghĩa quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Định nghĩa quan hệ với bảng Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
