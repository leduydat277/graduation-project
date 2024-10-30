<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DetailBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    const VIEW_PATH = 'admin.booking.';
    public function index()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    public function list(Request $request)
    {
        $perPage = $request->get('length', 10);
        $page = ($request->get('start', 0) / $perPage) + 1;
        $searchValue = $request->get('searchValue');
        $startDate = $request->get('startDate'); // Nhận giá trị ngày đến
        $endDate = $request->get('endDate'); // Nhận giá trị ngày đi
        $deposit_status = $request->get('deposit_status');
        $order_status = $request->get('order_status');
        $create_at = $request->get('create_at'); // Nhận giá trị ngày đi

        $orderColumnIndex = $request->get('orderColumn', 0);
        $orderDir = $request->get('orderDir', 'asc');

        $columns = ['id', 'total_price', 'check_in_date', 'check_out_date', 'type', 'deposit_status', 'status_id', 'create_at'];
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';

        $query = Booking::with(['status'])
            ->select(['id', 'total_price', 'deposit_status', 'status_id', 'create_at', 'check_in_date', 'check_out_date', 'type']);

        // Lọc theo giá trị tìm kiếm
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }

        if (!empty($deposit_status)) {
            $query->where('deposit_status', $request->deposit_status);
        }

        if (!empty($order_status)) {
            $query->where('status_id', $order_status);
        }

        if (!empty($create_at)) {
            $query->whereDate('create_at',  $create_at);
        }

        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('deposit_status', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('status', function ($statusQuery) use ($searchValue) {
                        $statusQuery->where('name', 'like', '%' . $searchValue . '%');
                    });
            });
        }

        if (!empty($startDate) && !empty($endDate)) {
            // Lọc các bản ghi có check_in_date >= startDate và check_out_date <= endDate
            $query->whereDate('check_in_date', '>=', $startDate)
                ->whereDate('check_out_date', '<=', $endDate);
        } elseif (!empty($startDate)) {
            // Nếu chỉ có startDate, lọc theo ngày đến
            $query->whereDate('check_in_date', '>=', $startDate);
        } elseif (!empty($endDate)) {
            // Nếu chỉ có endDate, lọc theo ngày đi
            $query->whereDate('check_out_date', '<=', $endDate);
        }

        $query->orderBy($orderColumn, $orderDir);

        $bookings = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => $bookings->total(),
            'recordsFiltered' => $bookings->total(),
            'data' => $bookings->items()
        ], 200);
    }

    public function detail($id)
    {
        $booking = Booking::with(['user', 'status'])
            ->select(['id', 'user_id', 'total_price', 'deposit_status', 'status_id', 'create_at', 'check_in_date', 'check_out_date', 'VAT', 'surcharge', 'deposit_amount', 'deposit_date', 'deposit_refund_date', 'type'])
            ->findOrFail($id);

        $detail = DetailBooking::with(['booking', 'room', 'roomType'])
            ->where('booking_id', $id)  // Sử dụng where để tìm theo booking_id
            ->select('booking_id', 'room_id', 'room_type_id', 'CCCD', 'actual_number_people')
            ->get();
        return view('admin.booking.detail', compact(['booking', 'detail']));
    }
}
