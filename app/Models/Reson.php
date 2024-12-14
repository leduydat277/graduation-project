<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reson extends Model
{
    public $timestamps = false;

    protected $table = 'resons';

    protected $fillable = [
        'reason'
    ];
}
