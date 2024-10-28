<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenities extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'room_amenities';

    public function typeAmenity()
    {
        return $this->belongsTo(TypeAmenities::class, 'amenities_id');
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
