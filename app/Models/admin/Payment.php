<?php

namespace App\Models\Admin;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Khai báo tên bảng và các thuộc tính có thể điền được
    protected $table = 'payments';
    protected $fillable = [
        'booking_id',
        'payment_date',
        'total_price',
        'payment_method',
        'payment_status',
        'created_at',
        'updated_at'
    ];

    // Định dạng các cột ngày tháng để Laravel tự động chuyển đổi
    protected $casts = [
        'payment_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Định nghĩa mối quan hệ với bảng Bookings (nếu có)
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Phương thức để tìm kiếm theo khoảng ngày
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('payment_date', [$startDate, $endDate]);
    }

    public function getPaymentStatusTextAttribute()
    {
        $statuses = [
            0 => 'chưa thanh toán cọc',
            1 => 'đang thanh toán',
            2 => 'đã thanh toán cọc',
            3 => 'đã thanh toán tổng tiền đơn',
        ];

        return $statuses[$this->payment_status] ?? 'Không xác định';
    }
}
