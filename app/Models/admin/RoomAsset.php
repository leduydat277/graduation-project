<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAsset extends Model
{
    use HasFactory;

    // Đặt tên bảng cho model (nếu tên bảng không theo chuẩn Laravel)
    protected $table = 'roomassets';

    // Các cột có thể được gán giá trị hàng loạt
    protected $fillable = [
        'room_id',
        'assets_type_id',
        'status',
    ];

    /**
     * Mối quan hệ với model Room.
     * Mỗi RoomAsset thuộc về một Room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Mối quan hệ với model AssetType.
     * Mỗi RoomAsset thuộc về một AssetType.
     */
    public function assetType()
    {
        return $this->belongsTo(AssetType::class, 'assets_type_id');
    }

    public $timestamps = false;
}