<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function status()
{
    return $this->belongsTo(Status::class, 'status_id');
}
}
