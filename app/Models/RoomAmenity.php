<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    use HasFactory;

    protected $table = 'room_amenities';

    protected $fillable = [
        'amenities_id',
        'room_id',
        'status_id',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function typeAmenity()
    {
        return $this->belongsTo(TypeAmenity::class, 'amenities_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
