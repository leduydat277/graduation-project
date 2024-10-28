<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAmenities extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'type_amenities';

    public function roomAmenities()
    {
        return $this->hasMany(roomAmenities::class);
    }
}
