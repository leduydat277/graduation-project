<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'assets_type_id', 'room_id', 'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function assetsType()
    {
        return $this->belongsTo(AssetsType::class);
    }
}
