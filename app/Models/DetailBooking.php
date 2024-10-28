<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    use HasFactory;
    protected $table = 'detail_bookings';

    public function booking()
    {
        return $this->belongsTo( Booking::class, 'booking_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    protected $fillable = [
        'booking_id',
        'room_id',
        'room_type_id',
        'CCCD',
        'actual_number_people',
    ];

    public $timestamps = false;
}
