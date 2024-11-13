<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'CCCD', 'password', 'image', 'role', 'phone', 'address'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
