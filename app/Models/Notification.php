<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";

    protected $fillable = [
        "user_id",
        "title",
        "message",
        "is_read",
        "read_at",
    ];
}
