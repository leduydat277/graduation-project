<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'first_name.required' => 'Vui lòng nhập tên của bạn.',
            'last_name.required' => 'Vui lòng nhập họ của bạn',
            'first_name.max' => 'Tên của bạn không được quá 50 kí tự.',
            'last_name.max' => 'Họ của bạn không được quá 50 kí tự.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Email không đúng định dạng.',
        ];
    }

    public function booking(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $check_in_date = $request->input('check_in_date');
            $check_out_date = $request->input('check_out_date');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $address = $request->input('address');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $room_id = $request->input('room_id');
            $checkInDate = Carbon::createFromFormat('dmY', (string)$check_in_date);
            $checkOutDate = Carbon::createFromFormat('dmY', (string)$check_out_date);
            $daysBooked = $checkInDate->diffInDays($checkOutDate);

            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'phone' => 'required|regex:/^[0-9]{10}$/',
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => 'required|email'
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    "type" => "error",
                    "message" => $validator->errors()
                ], 400);
            }

            if ($request->user_id) {
                $user = User::where('id', $user_id)->first();
                $user->first_name = $first_name;
                $user->last_name = $last_name;
                $user->address = $address;
                $user->phone = $phone;
                $user->save();
            }

            $room = Room::where('id', $room_id)->first();
            $total_price = $room->price*$daysBooked;
            $depositAmount = $total_price*0.3;

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

            if ($room->status == 4) {
                return response()->json([
                    "type" => "error",
                    "message" => "Phòng đang được khóa để thanh toán."
                ], 400);
            }

            $room->status = 4;
            $room->save();

            $bookings = Booking::select('room_id', 'check_in_date', 'check_out_date', 'status')
                ->where('room_id', $room->id)
                ->get();

            foreach ($bookings as $booking) {
                if (($check_in_date >= $booking->check_in_date
                        && $check_in_date < $booking->check_out_date)
                    && in_array($booking->status, [1, 2, 3, 4])
                ) {
                    return response()->json([
                        "type" => "error",
                        "message" => "Phòng đã có người đặt trước đó."
                    ], 406);
                }
            }

            if ($request->user_id) {
                $booking = Booking::create([
                    "room_id" => $room_id,
                    "user_id" => $user_id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "check_in_date" => $check_in_date,
                    "check_out_date" => $check_out_date,
                    "total_price" => $total_price,
                ]);
            }

            $booking = Booking::create([
                "room_id" => $room_id,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "check_in_date" => $check_in_date,
                "check_out_date" => $check_out_date,
                "total_price" => $total_price,
            ]);

            Payment::create([
                "booking_id" => $booking->id,
                "total_price" => $depositAmount
            ]);

            return response()->json([
                "message" => "Booking successful",
                "data" => $booking,
                "room" => $room
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Booking failed",
                "error" => [
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTrace()
                ]
            ], 500);
        }
    }
}
