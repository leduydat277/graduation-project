<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;

    protected $table = 'others';
    protected $fillable = [
        'name',
        'type',
        'description',
        'value',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'integer',
        'updated_at' => 'integer',
    ];
}
