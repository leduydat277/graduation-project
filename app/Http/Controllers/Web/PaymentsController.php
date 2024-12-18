<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function paymentHistory(Request $request)
    {
        $usersDefault = Auth::user();
        $dataPayment = Payment::with(['booking.user'])->whereHas('booking', function ($query) use ($usersDefault) {
            $query->where('user_id', $usersDefault->id);
        })->get();
        $dataStatus = [
            0 => "Chưa thanh toán cọc",
            1 => "Đang thanh toán",
            2 => "Đã thanh toán cọc",
            3 => "Đã thanh toán tổng tiền đơn",
            4 => "Đang sử dụng",
            5 => "Đã hủy",
            6 => "Hoàn thành"
        ];

        // dd($dataPayment->toArray());

        return view("client.paymentHistory", compact("dataPayment", "dataStatus"));
    }

    public function paymentHistoryDetail(Request $request, $id)
    {
        $usersDefault = Auth::user();
        $dataPayment = Payment::with(['booking.room',])->where("id", $id)->whereHas('booking', function ($query) use ($usersDefault) {
            $query->where('user_id', $usersDefault->id);
        })->first();
        $dataBooking = $dataPayment->booking;
        $dataStatus = [
            0 => 'Chưa thanh toán cọc',
            1 => 'Đang thanh toán',
            2 => 'Đã thanh toán cọc',
            3 => 'Đã thanh toán tổng tiền đơn',
            4 => 'Đang sử dụng',
            5 => 'Đã hủy',
            6 => '',
        ];
        return view("client.paymentHistoryDetail", compact("dataBooking", "dataStatus"));
    }
}
