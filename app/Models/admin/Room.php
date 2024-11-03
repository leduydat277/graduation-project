<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Định nghĩa các trường có thể gán hàng loạt
    protected $fillable = [
        'title',
        'room_type_id',
        'image_room',
        'max_people',
        'price',
        'room_area',
        'description',
        'status'
    ];

    // Chuyển đổi cột image_room từ JSON thành mảng
    protected $casts = [
        'image_room' => 'array',
    ];

    /**
     * Mối quan hệ với loại phòng (room_type).
     * Giả sử rằng bảng room_types có model RoomType
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Mối quan hệ với các tiện nghi (nếu có).
     * Giả sử rằng bạn có bảng `amenities` liên quan với nhiều tiện nghi cho mỗi phòng.
     */

     public $timestamps = false;
}
