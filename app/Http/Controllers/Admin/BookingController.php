<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\ManageStatusRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class BookingController  extends Controller
{
    private $messages;
    private $dateNow;
    public function __construct()
    {
        $this->dateNow = Carbon::now()->timestamp;
        $this->messages = [
            "name.required" => "Tên khách hàng không được để trống",
            "name.string" => "Tên phải là chuỗi",
            "name.max" => "Tên quá dài",
            "email.required" => "Email không được để trống",
            "email.string" => "Email phải là chuỗi",
            "email.email" => "Email không đúng định dạng",
            "check_in_date.required" => "Ngày đến không được để trống",
            "check_out_date.required" => "Ngày đi không được để trống",
            "max_people.required" => "Số lượng người tối đa không được để trống",
            "room_id.required" => "Phòng không được để trống",
            "room_type.required" => "Loại phòng không được để trống",
            "CCCD.required" => "CCCD không được để trống"
        ];
    }
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
        $bookings = $query->whereNot('status', [0,1])->get(); // Phân trang, mỗi trang 10 bản ghi

        return view(self::VIEW_PATH . __FUNCTION__, compact('bookings'));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email",
            "check_in_date" => "required",
            "check_out_date" => "required",
            'max_people' => 'required',
            'room_id' => 'required',
            'room_type' => 'required',
            'CCCD' => 'required',
        ], $this->messages);

        return view(self::VIEW_PATH . __FUNCTION__, compact('booking'));
    }

    // viết cho tôi hàm hủy đặt phòng
    // các trạng thái
    // 0: Chưa thanh toán cọc
    // 1: Đang thanh toán cọc
    // 2: Đã thanh toán cọc
    // 3: Đã thanh toán toàn bộ
    // 4: Đang sử dụng
    // 5: huy đặt phòng
    // nếu trạng thái  === 2,3,4 thì không thể hủy

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->status === 3 || $booking->status === 4 || $booking->status === 6) {
            return redirect()->back()->with('error', 'Không thể hủy đơn đặt phòng này');
        }

        
        $currentTimestamp = Carbon::now()->addDay()->setTime(14, 0)->timestamp;
        if ($booking->check_in_date < $currentTimestamp) {
            // $today = Carbon::now()->timestamp;
            $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
            foreach ($manage_status_rooms as $manage_status_room) {
                $manage_status_room->delete();
            }

            ManageStatusRoom::create([
                'booking_id' => $id,
                'room_id' => $booking->room_id,
                'from' => $currentTimestamp,
                'to' => $booking->check_out_date,
                'status' => 1,
            ]);
        }

        $booking->status = 5;
        $booking->save();


        return redirect()->back()->with('success', 'Hủy đặt phòng thành công');
    }
}
