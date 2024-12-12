<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    public $timestamps = false;
    use SoftDeletes;
    public $table = 'vouchers';

    protected $fillable = [
        'name',
        'description',
        'code_voucher',
        'discount_value',
        'start_date',
        'end_date',
        'type',
        'min_booking_amount',
        'quantity',
        'status',
    ];
}
