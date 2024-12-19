<?php

namespace App\Http\Controllers\Web;

use App\Models\Booking;
use App\Models\BookingCancelled;
use App\Models\Payment;
use App\Models\PhiPhatSinh;
use App\Models\Room;
use DateTime;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class HomeController
{
    public function index()
    {
        $title = "Trang chủ";
        return view('client.index', compact('title'));
    }
    public function rooms()
    {
        $title = "Phòng";
        return view('client.room', compact('title'));
    }

    public function roomAll()
    {
        $title = "Tất Cả Phòng";
        return view('client.room-all', compact('title'));
    }

    public function blog()
    {
        $title = "Bài Viết";
        return view('client.blog', compact('title'));
    }

    public function contact()
    {
        $title = "Liên hệ";
        return view('client.contact', compact('title'));
    }
    public function about()
    {
        $title = "Về chúng tôi";
        return view('client.about', compact('title'));
    }
    public function booking(HttpRequest $request)
    {
        $title = "Đặt phòng";

        if (!Auth::check()) {
            return redirect()->route('client.login');
        }

        if (!$request->has(['checkIn', 'room_id', 'checkout', 'adult_quantity'])) {
            return redirect()->back()->with('error', 'Bạn cần cung cấp đủ thông tin để đặt phòng.');
        }

        $checkIn = $_GET['checkIn'];
        $room_id = $_GET['room_id'];
        $checkout = $_GET['checkout'];
        $adult_quantity = $_GET['adult_quantity'];

        $checkIn = date("d-m-Y", strtotime($checkIn));
        $checkout = date("d-m-Y", strtotime($checkout));

        $checkInDate = new DateTime($checkIn);
        $checkoutDate = new DateTime($checkout);

        $totalDays = $checkInDate->diff($checkoutDate)->days;
        $room = Room::where('id', $room_id)->first();
        return view('client.booking', compact(['title', 'checkIn', 'checkout', 'adult_quantity', 'room', 'totalDays']));
    }
    public function review()
    {
        $title = "Đánh giá & bình luận";
        return view('client.review', compact('title'));
    }
    public function policy()
    {
        $title = "Điều khoản";
        return view('client.policy', compact('title'));
    }

    public function booking_detail($bookingNumberId)
    {
        $title = "Chi tiết đặt phòng";

        $booking = Booking::where('booking_number_id', $bookingNumberId)->with('room')->first();
        $payment = Payment::where('booking_id', $booking->id)->first();
        $cancel = BookingCancelled::where('booking_id', $booking->id)->first();
        $phiphatsinh = PhiPhatSinh::where('booking_id', $booking->id)->where('status', 1)->get();
        $totalFee = 0;
        foreach ($phiphatsinh as $item) {
            $totalFee += (int) $item->price;
        }
        $totalDays = \Carbon\Carbon::createFromTimestamp($booking->check_in_date)
            ->diffInDays(\Carbon\Carbon::createFromTimestamp($booking->check_out_date));

        return view('client.booking-detail', compact('title', 'booking', 'payment', 'totalDays', 'cancel', 'phiphatsinh', 'totalFee'));
    }

    public function done_booking_detail($bookingNumberId)
    {
        $title = "Chi tiết đặt phòng";

        $booking = Booking::where('booking_number_id', $bookingNumberId)->with('room')->first();
        $payment = Payment::where('booking_id', $booking->id)->first();
        $cancel = BookingCancelled::where('booking_id', $booking->id)->first();
        $totalDays = \Carbon\Carbon::createFromTimestamp($booking->check_in_date)
            ->diffInDays(\Carbon\Carbon::createFromTimestamp($booking->check_out_date));

        session()->flash('status', 'success');
        session()->flash('message', 'Bạn đã đặt phòng thành công!');

        return view('client.booking-detail', compact('title', 'booking', 'payment', 'totalDays', 'cancel'));
    }

    public function getBookingList(Request $request)
    {
        $user = Auth::user();

        $bookings = Booking::where('user_id', $user->id)
            ->with('room')
            ->where('status', '!=', 0)
            ->paginate(10);

        $dataStatus = [
            0 => "Chưa thanh toán cọc",
            1 => "Đang thanh toán",
            2 => "Đã thanh toán cọc",
            3 => "Đã thanh toán tổng tiền đơn",
            4 => "Đang sử dụng",
            5 => "Đã hủy",
            6 => "Hoàn thành"
        ];

        return view("client.bookingList", compact("bookings", "dataStatus"));
    }
}
