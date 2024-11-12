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


    // Room.php
    public function manageStatusRooms()
    {
        return $this->hasMany(ManageStatusRoom::class, 'room_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id');
    }

    public $timestamps = false;
}
