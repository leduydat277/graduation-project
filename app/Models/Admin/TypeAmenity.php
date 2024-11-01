<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAmenity extends Model
{
    use HasFactory;

    protected $table = 'type_amenities';

    protected $fillable = [
        'name',
        'description',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function roomAmenities()
    {
        return $this->hasMany(RoomAmenity::class);
    }
}
