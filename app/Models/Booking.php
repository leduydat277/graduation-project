<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'booking_number_id','room_id', 'user_id', 'code_check_in', 'check_in_date',
        'check_out_date', 'total_price', 'tien_coc', 'status', 'created_at'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function phiPhatSinhs()
    {
        return $this->hasMany(PhiPhatSinh::class);
    }

    public function manageStatusRoom()
    {
        return $this->hasOne(ManageStatusRoom::class);
    }
}
