<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\BookingCancelled;
use App\Models\ManageStatusRoom;
use App\Models\Payment;
use App\Models\PhiPhatSinh;
use App\Models\Reson;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Str;

class CheckInCheckOutController extends RoutingController
{

    public function detail($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentHour = date('H');

        if ($currentHour >= 14 && $currentHour <= 21) {
            $submitCheckIn = 0;
        } else {
            $submitCheckIn = 1;
        }
        $booking = Booking::find($id);
        $room = Room::find($booking->room_id);
        $phiPhatSinh = PhiPhatSinh::where('booking_id', $id)->first();
        $payments = Payment::where('booking_id', $id)->get();
        $title = "Chi tiết đơn";
        return view('admin.checkin_checkout.detail', compact('booking', 'room', 'phiPhatSinh', 'payments', 'title', 'submitCheckIn'));
    }

    public function index(Request $request)
    {$title = "Checkin & Checkout";
        $reson = Reson::all();
        $bookings = Booking::whereIn('bookings.status', [2,3, 4])
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select(
                'bookings.*',
                'users.name as user_name',
                'users.email as user_email',
                'users.phone as user_phone',
                'room_types.type as room_type',
                'rooms.roomId_number as room_id'
            )
            ->get();

        $phiphatsinhs = PhiPhatSinh::where('status', 0)->get(); 

        return view('admin.checkin_checkout.index', compact('bookings', 'title', 'phiphatsinhs', 'reson'));
    }


    public function checkIn(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 4;
        $booking->check_in_date = Carbon::now()->timestamp;
        $booking->CCCD_booking = $request->cccd;
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
        $tong = 0;
        foreach ($request->price as $item){
            $tong += $item;
        }
        $tong += $request->tienno;
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
        if ($booking->check_out_date == $currentTimestamp) { 
            $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
            foreach ($manage_status_rooms as $manage_status_room) {
                $manage_status_room->delete();
            }
        }
        if ($booking->check_out_date <= $currentTimestamp) {
            $today = Carbon::now()->timestamp;
            $checkoutNew = $booking->check_out_date;
            $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
            foreach ($manage_status_rooms as $manage_status_room) {
                $manage_status_room->delete();
            }
            ManageStatusRoom::create([
                'booking_id' => $id,
                'room_id' => $booking->room_id,
                'from' => $today,
                'to' => $checkoutNew,
                'status' => 1,
            ]);
        }

        $booking->status = 6;
        $booking->check_out_date = $currentTimestamp;
        $totalUpdate = $booking->discount_price;
        if($booking->tien_coc == null){
            $booking->discount_price = (int)$totalUpdate + (int)$request->totalPrice;
        }
        else{
            $cocs = 0;
            foreach($request->price as $coc){
                $cocs += $coc;
            }
            $booking->discount_price = (int)$totalUpdate + (int)$cocs;
        }
        $booking->save();
        $manage_status_rooms = ManageStatusRoom::where('booking_id', $id)->get();
        foreach ($manage_status_rooms as $status_room) {
            $status_room->status = 1;
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
                    'payments_id_number' => Str::random(6),
                    'payment_date' => Carbon::now()->timestamp,
                    'payment_method' => 0,
                    'payment_status' => 3,
                    'total_price' => $tong,
                ]
            );
        $payment->save();
        return redirect()->route('checkin-checkout.index')->with('success', 'Check-out thành công');
    }

    public function cancel(Request $request){
        $bookingId = $request->id;
        $today = Carbon::now();

        $booking = Booking::where('id', $bookingId)->first();
        if ($booking->status == 5) {
            return redirect()->route('checkin-checkout.index')->with('errot', 'phòng nãy đã được hủy rồi');
        }

        $reson = Reson::where('id', $request->reson)->first();

        $createdAt = Carbon::createFromTimestamp($booking->created_at);
        $checkInTime = Carbon::createFromTimestamp($booking->check_in_date);

        $refundAmount = 0;

        if ($today->diffInMinutes($createdAt) <= 60) {
            $refundAmount = '100';
        } elseif ($today->diffInMinutes($createdAt) > 60 && $today->lt($checkInTime->setTime(12, 0, 0))) {
            $refundAmount = '50';
        } elseif ($today->gte($checkInTime->setTime(12, 0, 0))) {
            $refundAmount = '0';
        }

        ManageStatusRoomController::cancel($bookingId);

        $booking->status = 5;
        $booking->save();
            BookingCancelled::create([
                'booking_id' => $bookingId,
                'reason' => $reson->reson,
                'description' => $request->description,
                'refund' => $refundAmount,
                'cancelled_at' => $today->timestamp,
                "status" => 'approved'
            ]);
        return redirect()->route('checkin-checkout.index')->with('success', 'Hủy đơn thành công!');

    }
}
