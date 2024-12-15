<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'room_type_id',
        'image_room',
        'max_people',
        'title',
        'price',
        'room_area',
        'description',
        'status'
    ];

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
    public function roomAssets()
    {
        return $this->hasMany(RoomAsset::class);
    }
}
