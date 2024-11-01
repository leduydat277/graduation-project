<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmailSetting extends Model
{
    use HasFactory;

    protected $table = 'gmail_setting';

    protected $fillable = [
        'status_id',
        'content',
        'type',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;
}
