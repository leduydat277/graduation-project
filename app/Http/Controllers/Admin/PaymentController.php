<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{

    const VIEW_PATH = 'admin.payments.';

    public function index(Request $request)
    {
        $dateRange = $request->input('date_range');
        $status = $request->input('payment_status');
        $search = $request->input('search');
        $title = 'Danh sách thanh toán';

        $query = Payment::with('booking');

        if ($search) {
            $query->where(function ($q) use ($search) {
                // Tìm kiếm theo mã đơn
                $q->where('payments_id_number', 'LIKE', "%{$search}%")
                    // Tìm kiếm theo họ, tên riêng biệt hoặc cả họ và tên kết hợp
                    ->orWhereHas('booking', function ($subQuery) use ($search) {
                        $subQuery->whereRaw("CONCAT(first_name, ' ',last_name) LIKE ?", ["%{$search}%"])
                            ->orWhere('last_name', 'LIKE', "%{$search}%")
                            ->orWhere('first_name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($dateRange || $status !== null) {

            if ($dateRange) {

                [$startDate, $endDate] = explode(' to ', $dateRange);

                $startTimestamp = strtotime($startDate);
                $endTimestamp = strtotime($endDate);

                $query->whereBetween('payment_date', [$startTimestamp, $endTimestamp]);
            }

            if (!is_null($status)) {
                $query->where('payment_status', $status);
            }
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(10);

        return view(self::VIEW_PATH . __FUNCTION__, compact('payments', 'dateRange', 'status', 'search', 'title'));
    }

    public function show($id)
    {
        // Tìm kiếm hóa đơn thanh toán theo id và tải trước các quan hệ cần thiết
        $payment = Payment::with(['booking', 'booking.room', 'booking.room.roomType', 'booking.user'])->findOrFail($id);
        // Trả về view và truyền dữ liệu
        return view(self::VIEW_PATH . __FUNCTION__, compact('payment'));
    }

    public function generatePDF($id)
    {
        $payment = Payment::with(['booking', 'booking.room', 'booking.room.roomType', 'booking.user'])->findOrFail($id);

        // Tạo file PDF với kích thước giấy A4 hoặc kích thước khác nếu muốn
        $pdf = Pdf::loadView('admin.payments.pdf', compact('payment'))
            ->setPaper('A4', 'portrait'); // Hoặc 'landscape' cho khổ ngang

        return $pdf->download('HoaDon_' . $payment->payments_id_number . '.pdf');
    }
}
