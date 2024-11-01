<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'status_id',
        'amount',
        'payment_date',
        'payment_method',
        'code',
        'payment_gateway_response',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
