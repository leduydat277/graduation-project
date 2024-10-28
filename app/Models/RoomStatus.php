<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
    use HasFactory;
    protected $table = 'room_statuses';

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
