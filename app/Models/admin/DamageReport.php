<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    use HasFactory;

    protected $table = 'damage_reports';

    protected $fillable = [
        'room_id',
        'status_id',
        'user_id',
        'booking_id',
        'damage_type',
        'compensation_amount',
        'description',
        'reported_at',
        'resolved_at',
        'create_at',
        'update_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function images()
    {
        return $this->hasMany(DamageReportsImage::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
