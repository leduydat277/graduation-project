<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    protected $fillable = ["name", "email", "password", "image", "role", "phone", "address", "status_id", "code"];
    protected $table = "users";
    public $timestamps = false;
}
