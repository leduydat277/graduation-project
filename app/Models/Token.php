<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'value', 'expiry_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}