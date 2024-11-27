<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookingController  extends Controller
{

    const VIEW_PATH = 'admin.bookings.';
    public function index(Request $request)
    {
        $query = Booking::with('room', 'user');

        // Tìm kiếm theo ID đơn, tên user, hoặc CCCD
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', "%$search%");
                    })
                    ->orWhere('cccd_booking', 'like', "%$search%");
            });
        }

        // Lọc theo trạng thái
        if ($request->has('status') && $request->input('status') !== null) {
            $query->where('status', $request->input('status'));
        }

        // Lọc theo khoảng thời gian
        if ($request->has('date_range') && !empty($request->input('date_range'))) {
            $dateRange = explode(' to ', $request->input('date_range'));

            if (count($dateRange) === 2) {
                // Lấy cả ngày và giờ (nếu có) từ input
                $startDateTime = trim($dateRange[0]); // Ngày bắt đầu
                $endDateTime = trim($dateRange[1]);   // Ngày kết thúc

                // Chuyển đổi sang timestamp (giây từ epoch)
                $startDate = strtotime($startDateTime); // Giờ bắt đầu từ input, dạng 1733234400
                $endDate = strtotime($endDateTime);     // Giờ kết thúc từ input, dạng 1733234400
                // In ra để kiểm tra

                $query->where(function ($subQuery) use ($startDate, $endDate) {
                    $subQuery->whereBetween('check_in_date', [$startDate, $endDate]) // Check-in nằm trong khoảng
                        ->orWhereBetween('check_out_date', [$startDate, $endDate]) // Check-out nằm trong khoảng
                        ->orWhere(function ($query) use ($startDate, $endDate) { // Bao trùm toàn bộ khoảng
                            $query->where('check_in_date', '<=', $startDate)
                                ->where('check_out_date', '>=', $endDate);
                        });
                });
            }
        }
        // dd($query->toSql() , $query->getBindings());
        // Lấy danh sách đặt phòng
        $bookings = $query->get(); // Phân trang, mỗi trang 10 bản ghi

        return view(self::VIEW_PATH . __FUNCTION__, compact('bookings'));
    }


    public function show($id)
    {
        $booking = Booking::with('room.roomType', 'user')->findOrFail($id);

        return view(self::VIEW_PATH . __FUNCTION__, compact('booking'));
    }
}
