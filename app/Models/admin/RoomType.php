<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = "room_types";

    protected $fillable = [
        'type',
    ];

    public $timestamps = false;


    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type_id');
    }
}
