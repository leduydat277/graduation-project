<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class BookingController
{
    private $messages;
    public function __construct()
    {
        $this->messages = [
            'address.required' => 'Vui lòng nhập địa chỉ của bạn.',
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn',
            'phone.number' => 'Vui lòng nhập số',
            'phone.regex' => 'Số điện thoại không đúng định dạng. Vui lòng nhập đúng số điện thoại.',
        ];
    }

    public function booking(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            $check_in_date = $request->input('check_in_date');
            $check_out_date = $request->input('check_out_date');
            $total_price = $request->input('total_price');
            $address = $request->input('address');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $room_id = $request->input('room_id');

            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'phone' => 'required|regex:/^[0-9]{10}$/',
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    "type" => "error",
                    "message" => $validator->errors()
                ], 400);
            }

            $user = User::where('email', $email)->first();
            $user->address = $address;
            $user->phone = $phone;
            $user->save();

            $room = Room::where('id', $room_id)->first();
            if ($room->status == 2) {
                return response()->json([
                    "type" => "error",
                    "message" => "Phòng đang có người sử dụng."
                ], 400);
            }

            if ($room->status == 1) {
                return response()->json([
                    "type" => "error",
                    "message" => "Phòng đã có khách cọc."
                ], 400);
            }

            if ($room->status == 3) {
                return response()->json([
                    "type" => "error",
                    "message" => "Phòng đang hỏng."
                ], 400);
            }

            $bookings = Booking::select('room_id', 'check_in_date', 'check_out_date', 'status')
                ->where('room_id', $room->id)
                ->whereDate('check_in_date', '>=', Carbon::today()->format('Y-m-d'))
                ->get();

            foreach ($bookings as $booking) {
                if (($check_in_date >= $booking->check_in_date
                    &&
                    $check_in_date <= $booking->check_out_date) && $booking->status == [1, 2, 3]) {
                    return response()->json([
                        "type" => "error",
                        "message" => "Phòng đã có người đặt trước đó."
                    ], 406);
                }
            }

            $booking = Booking::create([
                "room_id" => $room_id,
                "user_id" => $user_id,
                "check_in_date" => $check_in_date,
                "check_out_date" => $check_out_date,
                "total_price" => $total_price,
            ]);

            Payment::create([
                "booking_id" => $booking->id
            ]);

            return response()->json([
                "message" => "Booking successful",
                "data" => $booking
            ], 200);
        } catch (Exception $e) {
            $errorMessage = env('APP_DEBUG') ? $e->getMessage() : "Booking failed, please try again.";

            return response()->json([
                "message" => "Booking failed",
                "error" => $e
            ], 500);
        }
    }
}
