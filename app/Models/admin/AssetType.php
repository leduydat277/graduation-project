<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    use HasFactory;

    // Đặt tên bảng
    protected $table = 'assets_types';

    // Các trường có thể được gán giá trị
    protected $fillable = [
        'name',
        'description',
    ];

     /**
     * Mối quan hệ với RoomAsset.
     * Một AssetType có thể có nhiều RoomAsset liên kết.
     */
    public function roomAssets()
    {
        return $this->hasMany(RoomAsset::class, 'assets_type_id');
    }

    // Tùy chọn thêm (nếu cần) để sử dụng timestamps
    public $timestamps = false; // Nếu bảng không có trường `created_at` và `updated_at`
}
