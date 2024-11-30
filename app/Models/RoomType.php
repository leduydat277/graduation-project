<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    // Fillable properties (the attributes you can mass-assign)
    protected $fillable = [
        'roomType_number',
        'image',
        'type',
        'created_at',
        'updated_at',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
