<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

}
