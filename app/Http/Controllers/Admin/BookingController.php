<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookingController  extends Controller
{

    const VIEW_PATH = 'admin.bookings.';
    public function index(Request $request)
    {
        $query = Booking::with('room', 'user');

        // Tìm kiếm theo ID đơn, tên user, hoặc CCCD
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', $search)
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('cccd', 'like', "%$search%");
        }

        // Lọc theo trạng thái
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        // Lọc theo khoảng ngày
        if ($request->has(['from_date', 'to_date'])) {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $query->whereBetween('check_in', [$fromDate, $toDate]);
        }

        $bookings = $query->paginate(10);

        return view(self::VIEW_PATH . __FUNCTION__, compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with('room.roomType', 'user')->findOrFail($id);

        return view(self::VIEW_PATH . __FUNCTION__, compact('booking'));
    }
}
