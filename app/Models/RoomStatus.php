<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
    protected $fillable = [
        'room_id',
        'status_id',
        'description',
        'user_id',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
