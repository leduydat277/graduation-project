<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckInCheckoutRequest;
use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckInCheckOutController extends Controller
{
    const VIEW_PATH = "admin.checkincheckout.";
    public function index(Request $request)
    {
        $title = "Danh sách Check-in - Check-out";

        // Lấy các tham số từ request
        $search = $request->input('search', ''); // Tìm kiếm từ khóa (mặc định là chuỗi rỗng)
        $sortBy = $request->input('sort_by', 'id'); // Sắp xếp theo ID mặc định
        $sortOrder = $request->input('sort_order', 'asc'); // Thứ tự sắp xếp mặc định là tăng dần

        // Query cơ bản cho danh sách bookings với các quan hệ room và roomType qua detailBookings
        $query = Booking::with(['detailBooking', 'user', 'status'])
            ->where('deposit_status', 'paid'); // Chỉ lấy các booking có tiền cọc đã thanh toán

        // Nếu có từ khóa tìm kiếm, thêm điều kiện tìm kiếm dựa trên tên người dùng
        if (!empty($search)) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        // Sắp xếp theo trường và thứ tự được chỉ định
        $bookings = $query->orderBy($sortBy, $sortOrder)->paginate(10); // Phân trang 10 bản ghi mỗi trang

        // Trả về view với dữ liệu đã xử lý
        return view(self::VIEW_PATH . __FUNCTION__, compact('bookings', 'search', 'sortBy', 'sortOrder', 'title'));
    }






    public function checkIn(Request $request, $booking_id)
    {
        $title = "Check-In Phòng";

        // Lấy thông tin booking, bao gồm thông tin người dùng và phòng
        $booking = Booking::with(['user', 'detailBooking.room'])->findOrFail($booking_id);

        // Kiểm tra trạng thái xem đã check-in hay chưa (giả sử 2 là trạng thái đã check-in)
        if ($booking->status_id == 2) {
            return redirect()->back()->with('error', 'Khách hàng đã check-in rồi!');
        }

        // Lấy danh sách phòng trống cùng loại với phòng đã đặt (nếu cần)
        $rooms = Room::where('room_statuses_id', 1) // Lấy những phòng trống (room_statuses_id = 1)
            ->where('room_type_id', $booking->detailBooking->first()->room_type_id) // Loại phòng phù hợp
            ->with('roomType') // Eager load quan hệ room_type
            ->get();

        return view(self::VIEW_PATH . __FUNCTION__, compact('booking', 'rooms', 'title'));
    }




    public function checkInRequest(CheckInCheckoutRequest $request, $booking_id)
    {
        $cccd = $request->input('cccd'); // Nhận CCCD từ request
        $actualNumberPeople = $request->input('actual_number_people'); // Nhận số lượng người thực tế từ request
        $booking = Booking::find($booking_id);

        // Kiểm tra ngày hiện tại có nằm trong khoảng thời gian check-in hay không
        $currentDate = Carbon::now();
        if (!$currentDate->between($booking->check_in_date, $booking->check_out_date)) {
            return response()->json(['message' => 'Không thể check-in. Không đúng thời gian.'], 400);
        }

        if (!$booking) {
            return response()->json(['message' => 'Booking không tồn tại'], 404);
        }

        // Tìm detailBooking tương ứng với booking_id để lấy thông tin room_type_id
        $detailBooking = DetailBooking::where('booking_id', $booking->id)->first();

        if (!$detailBooking) {
            return response()->json(['message' => 'Không tìm thấy chi tiết booking'], 404);
        }

        // Lấy room_type_id từ detailBooking
        $roomTypeId = $detailBooking->room_type_id;

        // Tìm phòng trống thuộc loại phòng mà khách đã đặt (dựa vào room_type_id từ detailBooking)
        $availableRoom = Room::where('room_type_id', $roomTypeId)
            ->where('room_statuses_id', 1) // 1: Trạng thái phòng trống
            ->whereDoesntHave('detailBooking', function ($query) {
                $query->whereHas('booking', function ($bookingQuery) {
                    $bookingQuery->whereNull('check_out_date'); // Phòng đã được check-in nhưng chưa check-out
                });
            })
            ->first();

        if (!$availableRoom) {
            return response()->json(['message' => 'Không có phòng trống thuộc loại này'], 400);
        }

        // Cập nhật trạng thái phòng thành đã đặt
        $availableRoom->room_statuses_id = 2; // 2: Phòng đã được đặt
        $availableRoom->save();

        // Cập nhật room_id, CCCD và số lượng người thực tế trong detailBooking
        $detailBooking->room_id = $availableRoom->id;
        $detailBooking->CCCD = $cccd;
        $detailBooking->actual_number_people = $actualNumberPeople;
        $detailBooking->save();

        // Cập nhật trạng thái check-in trong bảng bookings
        $booking->status_id = 2; // 2 là trạng thái đã check-in
        $booking->save();

        return response()->json(['message' => 'Check-in thành công!'], 200);
    }



    public function checkOut($booking_id)
    {
        // Tìm booking với thông tin chi tiết các phòng đã đặt và người dùng
        $booking = Booking::with(['detailBooking.room', 'user'])->findOrFail($booking_id);

        // Kiểm tra trạng thái của booking: Chỉ cho phép check-out nếu booking đã check-in
        if ($booking->status_id != 2) { // 2 là trạng thái "đã check-in"
            return redirect()->back()->with('error', 'Booking này chưa check-in hoặc đã check-out!');
        }
        // dd($booking);   
        // Lấy thông tin các phòng đã đặt từ detailBookings
        $rooms = $booking->detailBooking->map(function ($detailBooking) {
            return $detailBooking->room;
        });

        $title = "Check-Out Phòng";

        // Trả về view để hiển thị thông tin check-out cho booking
        return view(self::VIEW_PATH . __FUNCTION__, compact('booking', 'rooms', 'title'));
    }



    public function checkOutRequest(CheckInCheckoutRequest $request, $booking_id)
    {
        // Tìm booking cùng với chi tiết phòng
        $booking = Booking::with('detailBooking.room')->findOrFail($booking_id);

        // Kiểm tra trạng thái của booking: chỉ cho phép check-out nếu trạng thái là "đã check-in"
        if ($booking->status_id != 2) { // 2 là trạng thái "đã check-in"
            return response()->json(['message' => 'Booking này chưa check-in hoặc đã check-out!'], 400);
        }

        // Lặp qua từng chi tiết booking để cập nhật trạng thái phòng
        foreach ($booking->detailBooking as $detailBooking) {
            $room = $detailBooking->room;

            // Kiểm tra xem phòng có tồn tại không
            if ($room) {
                // Cập nhật trạng thái phòng trở lại phòng trống (1: phòng trống)
                $room->room_statuses_id = 1;
                $room->save();
            }
        }

        // Cập nhật trạng thái booking thành "đã check-out" (giả sử 3 là trạng thái "đã check-out")
        $booking->status_id = 3;

        // Cập nhật ngày check-out cho booking
        $booking->check_out_date = Carbon::now(); // Đặt ngày check-out là thời gian hiện tại
        $booking->save();

        return response()->json(['message' => 'Check-out thành công!'], 200);
    }
}
