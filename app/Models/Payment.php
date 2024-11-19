<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'booking_id',
        'payment_date',
        'total_price',
        'payment_method',
        'payment_status',
        'vnp_BankCode',
        'vnp_TransactionNo	',
        '	updated_at'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}