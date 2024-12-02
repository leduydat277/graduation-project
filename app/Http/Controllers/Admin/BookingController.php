<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Booking;
use App\Models\admin\Room;
use App\Models\admin\RoomType;
use App\Models\admin\User;
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
        // Show all bookings
        $bookings = Booking::select("bookings.id", "bookings.room_id", "bookings.check_in_date", "bookings.check_out_date", "bookings.total_price", "bookings.tien_coc", "bookings.status", "users.name as user_name")
            ->join("users", "users.id", "=", "bookings.user_id")
            ->get();
        return view('admin.booking.index', compact('bookings'));
    }
    public function addUI(Request $request)
    {
        $dataRoomType = RoomType::get();
        return view('admin.booking.create', compact("dataRoomType"));
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

        if ($validator->fails()) {
            return redirect()->back() // Quay lại trang trước đó (addUI)
                ->withErrors($validator) // Gửi lỗi về view
                ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
        }

        // Thực hiện các bước xử lý còn lại nếu validate thành công    
        $name = $request->input("name");
        $email = $request->input("email");
        $password = $request->input("email");
        $check_in_date = $request->input("check_in_date");
        $check_out_date = $request->input("check_out_date");
        $max_people = $request->input("max_people");
        $room_id = $request->input("room_id");
        $CCCD = $request->input("CCCD");

        $check_in_timestamp = strtotime($check_in_date);
        $check_out_timestamp = strtotime($check_out_date);

        // Kiểm tra nếu strtotime trả về false (không hợp lệ)
        if ($check_in_timestamp === false || $check_out_timestamp === false) {
            // Xử lý lỗi ngày tháng không hợp lệ ở đây
            return redirect()->back()->withErrors("Ngày đến hoặc ngày đi không hợp lệ.");
        }

        // Tính toán tổng số ngày
        $days = ($check_out_timestamp - $check_in_timestamp) / 86400; // Chuyển đổi từ giây sang ngày

        if ($days <= 0) {
            // Kiểm tra nếu số ngày không hợp lệ
            return redirect()->back()->withErrors("Ngày đi phải sau ngày đến.");
        }

        $total_price = Room::find($room_id)->price * $days;

        $dataUsers = User::where("email", $email)->first();
        if ($dataUsers) {
            $dataUsers->update([
                "name" => $name,
                "cccd" => $CCCD,
            ]);
        } else {
            $dataUsers = User::create(
                [
                    "name" => $name,
                    "email" => $email,
                    "password" => bcrypt($password),
                    "role" => 0,
                    "cccd" => $CCCD,
                    "created_at" => $this->dateNow,
                    "updated_at" => $this->dateNow,
                ]
            );
        }


        Booking::create([
            "room_id" => $room_id,
            "user_id" => $dataUsers->id,
            "total_price" => $total_price,
            "status" => 0,
            "tien_coc" => 0,
            "check_in_date" => $check_in_timestamp,
            "check_out_date" => $check_out_timestamp,
            // "created_at" => $this->dateNow,
            // "updated_at" => $this->dateNow,
        ]);

        return redirect()->route('adminBooking.addUI')->with('success', 'Đặt phòng thành công.');
    }
}
