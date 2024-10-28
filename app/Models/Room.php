<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'room_type_id',
        'room_statuses_id',
        'number',
        'description',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

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
}
