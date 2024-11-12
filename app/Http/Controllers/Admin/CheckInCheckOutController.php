<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\ManageStatusRoom;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\DB;

class CheckInCheckOutController extends RoutingController
{
    public function index(Request $request)
    {
        $title = "Danh sách Đơn";
        $bookings = Booking::whereIn('bookings.status', [2, 3, 4])
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->leftJoin(DB::raw('(SELECT booking_id, GROUP_CONCAT(name) as phiphatsinh, SUM(price) as giaphiphatsinh FROM phiphatsinhs GROUP BY booking_id) as extra_fees'), 'extra_fees.booking_id', '=', 'bookings.id')
            ->select(
                'bookings.*',
                'users.name as user_name',
                'room_types.type as room_type',
                'rooms.id as room_id',
                DB::raw('COALESCE(extra_fees.phiphatsinh, "") as phiphatsinh'),
                DB::raw('COALESCE(extra_fees.giaphiphatsinh, 0) as giaphiphatsinh')
            )
            ->get();
        return view('admin.checkin_checkout.index', compact('bookings', 'title'));
    }


    public function checkIn(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 4;
        $booking->save();
        $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
        foreach ($manage_status_rooms as $status_room) {
            $status_room->status = 2;
            $status_room->save();
        }
        $id_user = $booking->user_id;
        $id_user = $booking->user_id;
        $user = User::find($id_user);
        $user->cccd = $request->cccd;
        $user->save();
        $room_id = $booking->room_id;
        $room = Room::find($room_id);
        $room->status = 2;
        $room->save();
        // $payment = Payment::where('booking_id', $id)->first();
        // $payment->payment_status = 3;
        // $payment->save();
        return redirect()->route('checkin-checkout.index')->with('success', 'Check-in thành công (đã lưu cccd vào csdl)');
    }

    public function checkOut(Request $request, $id)
    {
        $currentTimestamp = Carbon::now()->timestamp;
        $booking = Booking::findOrFail($id);
        // dd($currentTimestamp , $booking->check_out_date);
        if ($booking->check_out_date == $currentTimestamp) { // nếu checkout đúng ngày thì xóa
            $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
            foreach ($manage_status_rooms as $manage_status_room) {
                $manage_status_room->delete();
            }
        }
        if ($booking->check_out_date <= $currentTimestamp) {
            //xóa dương vô cực cũ, xong đặt dương vô cực từ now 
            $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)
                ->andWhere('to', 0);
        }
        $booking->status = 6; //6 là đơn này đã hoàn thành
        $booking->save();
        $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
        foreach ($manage_status_rooms as $status_room) {
            $status_room->status = 2;
            $status_room->save();
        }
        $room_id = $booking->room_id;
        $room = Room::find($room_id);
        $room->status = 0;
        $room->save();
        $payment = Payment::where('booking_id', $id)->first();
        $payment->payment_status = 3;
        $payment->save();
        return redirect()->route('checkin-checkout.index')->with('success', 'Check-out thành công');
    }
}
