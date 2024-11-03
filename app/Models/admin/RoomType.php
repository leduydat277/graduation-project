<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    // Quan hệ với Room
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
