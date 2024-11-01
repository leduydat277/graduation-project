<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types';

    protected $fillable = [
        'type',
        'default_people',
        'price_per_night',
        'description',
        'description_details',
        'title',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomTypeImages()
    {
        return $this->hasMany(RoomTypeImage::class);
    }
}
