<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function roomStatus()
    {
        return $this->belongsTo(RoomStatus::class, 'room_statuses_id');
    }

    public function damageReports()
    {
        return $this->hasMany(DamageReport::class);
    }

    public function detailBooking()
    {
        return $this->hasMany(DetailBooking::class, 'room_id');
    }
    public $timestamps = false;
}
