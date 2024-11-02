<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeImage extends Model
{
    use HasFactory;

    protected $table = 'room_type_images';

    protected $fillable = [
        'room_type_id',
        'image_url',
        'description',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
