<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'check_in_date',
        'check_out_date',
        'VAT',
        'total_price',
        'note',
        'surcharge',
        'deposit_amount',
        'deposit_status',
        'deposit_date',
        'deposit_refund_date',
        'type',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function detailBookings()
    {
        return $this->hasMany(DetailBooking::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
