<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Room;
use App\Models\admin\RoomType;
use App\Models\admin\User;
use App\Models\Booking;
use App\Models\ManageStatusRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookingController  extends Controller
{
    private $messages, $urlViews;
    private $dateNow;
    public function __construct()
    {
        $this->dateNow = Carbon::now()->timestamp;
        $this->messages = [
            "total_price.required" => "Tổng giá là bắt buộc.",
            "name.required" => "Tên khách hàng là bắt buộc.",
            "name.string" => "Tên khách hàng phải là chuỗi ký tự.",
            "name.max" => "Tên khách hàng không được vượt quá 255 ký tự.",
            "email.required" => "Email là bắt buộc.",
            "email.string" => "Email phải là chuỗi ký tự.",
            "email.email" => "Email không đúng định dạng, vui lòng nhập đúng email.",
            "check_in_date.required" => "Ngày đến là bắt buộc.",
            "check_out_date.required" => "Ngày đi là bắt buộc.",
            "max_people.required" => "Số lượng người tối đa là bắt buộc.",
            "room_id.required" => "Phòng không được để trống, vui lòng chọn phòng.",
            "room_type.required" => "Loại phòng là bắt buộc.",
            "CCCD.required" => "Số CCCD là bắt buộc.",
            "CCCD.max" => "Số CCCD tối đa 12 số.",
            "check_in_date.after" => "Ngày đến phải trước ngày đi.",
            "check_out_date.after" => "Ngày đi phải sau ngày đến.",
        ];
        
        $this->urlViews = 'admin.booking.';
    }
    public function index(Request $request)
    {
        $query = Booking::with('room', 'user');
      
        // Tìm ki   ếm theo ID đơn, tên user, hoặc CCCD
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
                $startDateTime = trim($dateRange[0]);
                $endDateTime = trim($dateRange[1]);
                $startDate = strtotime($startDateTime);
                $endDate = strtotime($endDateTime);
                $query->where(function ($subQuery) use ($startDate, $endDate) {
                    $subQuery->whereBetween('check_in_date', [$startDate, $endDate]) 
                        ->orWhereBetween('check_out_date', [$startDate, $endDate]) 
                        ->orWhere(function ($query) use ($startDate, $endDate) { 
                            $query->where('check_in_date', '<=', $startDate)
                                ->where('check_out_date', '>=', $endDate);
                        });
                });
            }
        }
        
        $bookings = $query->whereNotIn('status', [0, 1]) 
            ->orderBy('id', 'desc') 
            ->paginate(10); 

        return view("$this->urlViews.index", compact('bookings'));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email",
            "check_in_date" => "required|date",
            "check_out_date" => "required|date|after:check_in_date",
            'max_people' => 'required|integer|min:1',
            'room_id' => 'required|integer',
            'room_type' => 'required|string',
            'CCCD' => 'required|string',
            'total_price' => 'required|string',
        ], $this->messages);
        
        if ($validator->fails()) {
            return redirect()->back() 
                ->withErrors($validator) 
                ->withInput(); 
        }

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
        // Tính toán tổng số ngày
        $days = ($check_out_timestamp - $check_in_timestamp) / 86400; // Chuyển đổi từ giây sang ngày
        $roomData = Room::find($room_id);
        $total_price = $roomData->price * $days * $max_people;

        $dataUsers = User::where("email", $email)->first();
        if ($dataUsers->status === 0) {
            return redirect()->back() 
            ->withErrors(["email" => "Email này đã bị khóa vui lòng thử email khác."]) // Gửi lỗi về view
            ->withInput(); // Giữ lại dữ liệu người dùng đã nhập
        } elseif($dataUsers){
            $dataUsers->update([
                "name" => $name,
                "cccd" => $CCCD,
            ]);
        }else {
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

        $bookingNumberId = Str::upper(Str::random(5));

        Booking::create([
            "room_id" => $room_id,
            "user_id" => $dataUsers->id,
            "total_price" => $total_price,
            "status" => 0,
            "tien_coc" => 0,
            "check_in_date" => $check_in_timestamp,
            "check_out_date" => $check_out_timestamp,
            "booking_number_id" => $bookingNumberId
        ]);

        return redirect()->route('adminBooking.addUI')->with('success', 'Đặt phòng thành công.');
    }

    public function addUI(Request $request)
    {
        $dataRoomType = RoomType::get();
        return view('admin.booking.create', compact("dataRoomType"));
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->status === 3 || $booking->status === 4 || $booking->status === 6) {
            return redirect()->back()->with('error', 'Không thể hủy đơn đặt phòng này');
        }


        $currentTimestamp = Carbon::now()->addDay()->setTime(14, 0)->timestamp;
        if ($booking->check_in_date < $currentTimestamp) {
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

    public function show($id)
    {
        $booking = Booking::with('room.roomType', 'user')->findOrFail($id);

        return view("admin.booking.show", compact('booking'));
    }
}
