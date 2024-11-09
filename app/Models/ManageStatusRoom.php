<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageStatusRoom extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'booking_id', 'room_id', 'status', 'from', 'to'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
