<?php

namespace App\Http\Controllers\Web;

use App\Models\Room;
use DateTime;
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
    public function booking(Request $request)
    {
        $title = "Đặt phòng";
        $checkIn = $_GET['checkIn'];
        $room_id = $_GET['room_id'];
        $checkout = $_GET['checkout'];
        $adult_quantity = $_GET['adult_quantity'];
        $children_quantity = $_GET['children_quantity'];

        $checkIn = date("d-m-Y", strtotime($checkIn));
        $checkout = date("d-m-Y", strtotime($checkout));

        $checkInDate = new DateTime($checkIn);
        $checkoutDate = new DateTime($checkout);

        $totalDays = $checkInDate->diff($checkoutDate)->days;
        $totalDays = $totalDays+1;
        $room = Room::where('id', $room_id)->first();
        return view('client.booking', compact(['title', 'checkIn', 'checkout', 'adult_quantity', 'children_quantity', 'room', 'totalDays']));
    }
    public function review()
    {
        $title = "Đánh giá & bình luận";
        return view('client.review', compact('title'));
    }
}
