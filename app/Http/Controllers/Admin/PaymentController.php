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
        // Nhận dữ liệu từ request
        $dateRange = $request->input('date_range');
        $status = $request->input('payment_status');
        $title = 'Danh sách thanh toán';

        // Tạo query cơ bản
        $query = Payment::query();

        // Lọc theo khoảng ngày nếu có
        if ($dateRange) {
            // Tách khoảng ngày thành ngày bắt đầu và ngày kết thúc
            [$startDate, $endDate] = explode(' to ', $dateRange);

            // Chuyển đổi chuỗi ngày sang định dạng `Y-m-d`
            $startDate = (new DateTime($startDate))->setTime(14, 0, 0)->getTimestamp();
            $endDate = (new DateTime($endDate))->setTime(14, 0, 0)->getTimestamp();

            // Lọc theo khoảng ngày
            $query->whereBetween('payment_date', [$startDate, $endDate]);
        }

        // Lọc theo trạng thái thanh toán nếu có
        if ($status !== null) {
            $query->where('payment_status', $status);
        }

        // Lấy danh sách các bản ghi
        $payments = $query->get();

        // Truyền dữ liệu sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('payments', 'dateRange', 'status', 'title'));
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

        return $pdf->download('HoaDon_' . $payment->id . '.pdf');
    }
}
