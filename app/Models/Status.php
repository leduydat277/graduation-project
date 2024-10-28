<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    
    public function reviews()
    {
        return $this->hasMany(Review::class, 'status_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'status_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'status_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'status_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'status_id');
    }
    public function roomAmenities()
    {
        return $this->hasMany(roomAmenities::class, 'status_id');
    }
    public function roomStatus()
    {
        return $this->hasMany(RoomStatus::class, 'status_id');
    }
}
