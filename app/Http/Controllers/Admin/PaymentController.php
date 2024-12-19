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
                $q->where('payments_id_number', 'LIKE', "%{$search}%")
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
        $payment = Payment::with(['booking', 'booking.room', 'booking.room.roomType', 'booking.user'])->findOrFail($id);
        return view(self::VIEW_PATH . __FUNCTION__, compact('payment'));
    }

    public function generatePDF($id)
    {
        $payment = Payment::with(['booking', 'booking.room', 'booking.room.roomType', 'booking.user', 'booking.phiPhatSinhs'])->findOrFail($id);
        $pdf = Pdf::loadView('admin.payments.pdf', compact('payment'))
            ->setPaper('A4', 'portrait'); 

        return $pdf->download('HoaDon_' . $payment->payments_id_number . '.pdf');
    }
}
