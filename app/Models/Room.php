<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

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

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function manageStatusRooms()
    {
        return $this->hasMany(ManageStatusRoom::class);
    }

    public function roomAssets()
    {
        return $this->hasMany(RoomAsset::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
