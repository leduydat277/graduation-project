<?php

namespace App\Models\Admin;

use App\Models\Admin\Booking;
use App\Models\Admin\Room;
use Illuminate\Database\Eloquent\Model;

class ManageStatusRoom extends Model
{
    protected $table = 'manage_status_rooms';

    public $timestamps = false;

    // Hằng số cho các trạng thái phòng
    const STATUS_DEPOSITED = 0;   // Đã cọc
    const STATUS_AVAILABLE = 1;   // Sẵn sàng
    const STATUS_IN_USE = 2;      // Đang sử dụng

    protected $fillable = [
        'booking_id',
        'room_id',
        'status',
        'from',
        'to'
    ];

    // Quan hệ với Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Quan hệ với Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Scope để lọc theo trạng thái phòng
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope để lọc theo khoảng thời gian
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->where('from', '>=', $startDate)
                     ->where('to', '<=', $endDate);
    }

    

}
