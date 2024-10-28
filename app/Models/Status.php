<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'name',
        'type',
        'color',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

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
        return $this->hasMany(RoomAmenity::class, 'status_id');
    }
    public function roomStatus()
    {
        return $this->hasMany(RoomStatus::class, 'status_id');
    }
}
