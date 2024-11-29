<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\ManageStatusRoom;
use App\Models\Payment;
use App\Models\PhiPhatSinh;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Log;

class CheckInCheckOutController extends RoutingController
{
    public function index(Request $request)
    {
        $title = "Danh sách Đơn";
        $bookings = Booking::whereIn('bookings.status', [2, 4])
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select(
                'bookings.*',
                'users.name as user_name',
                'users.email as user_email',
                'users.phone as user_phone',
                'room_types.type as room_type',
                'rooms.id as room_id'
            )
            ->get();
        Log::error($bookings);
        $phiphatsinhs = PhiPhatSinh::all();
        return view('admin.checkin_checkout.index', compact('bookings', 'title', 'phiphatsinhs'));
    }


    public function checkIn(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 4;
        $booking->CCCD_booking = $request->cccd; // lưu cccd của người checkin vào db booking
        $booking->save();
        $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
        foreach ($manage_status_rooms as $status_room) {
            $status_room->status = 2;
            $status_room->save();
        }
        $room_id = $booking->room_id;
        $room = Room::find($room_id);
        $room->status = 2;
        $room->save();
        return redirect()->route('checkin-checkout.index')->with('success', 'Check-in thành công');
    }

    public function checkOut(Request $request, $id)
    {
        var_dump($request);
        die;
        foreach ($request->pps as $index => $name) {
            $price = $request->price[$index];
            PhiPhatSinh::insert([
                'booking_id' => $id,
                'name' => $name,
                'price' => $price,
            ]);
        }
        $phiphatsinhs = PhiPhatSinh::where('booking_id', $id)->get();
        foreach ($phiphatsinhs as $phi) {
            $phi->status = 1;
            $phi->save();
        }
        $currentTimestamp = Carbon::now()->timestamp;
        $booking = Booking::findOrFail($id);
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
        $booking->status = 3;
        $booking->total_price = $request->totalPrice; //update tiền ở booking
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
        $payment->insert(
            [
                'booking_id' => $id,
                'payment_date' => Carbon::now()->timestamp,
                'payment_method' => 0,
                'payment_status' => 3,
                'total_price' => ($request->totalPrice - $request->tiencu),
            ]
        );
        $payment->save();
        return redirect()->route('checkin-checkout.index')->with('success', 'Check-out thành công');
    }


    public function cancel(Request $request)
    {
        $booking = Booking::find($request->id);
        $manage_status_room = ManageStatusRoom::where('from', $booking->check_in_date)
            ->where('status', 0)
            ->first();
        $manage_status_room->status = 1;
        $manage_status_room->save();
        $booking->status = 5;
        $booking->save();
        return redirect()->route('checkin-checkout.index')->with('success', 'Hủy đơn thành công!');
    }
}
