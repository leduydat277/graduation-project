<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCancelled extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'reason',
        'refund',
        'cancelled_at',
        'status'
    ];
}
