<?php

namespace App\Http\Controllers\Api;


use App\Events\NotificationMessage;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\ManageStatusRoomController;
use App\Http\Controllers\PaymentController;
use App\Models\Booking;
use App\Models\ManageStatusRoom;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Str;
use function Laravel\Prompts\error;

class BookingController
{
    private $messages;
    private $paymentController;
    public function __construct(PaymentController $paymentController)
    {
        $this->paymentController = $paymentController;
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
            'payment_type.required' => 'Vui lòng chọn phương thức thanh toán.'
        ];
    }

    public function checkDate($id)
    {
        try {
            $check = ManageStatusRoom::where('room_id', $id)->whereIn('status', [0, 2])->get();
            return response()->json([
                'type' => 'success',
                'data' => $check
            ]);
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

    public function confirmInfor(Request $request)
    {
        $checkIn = $request->input('checkin');
        $room_id = $request->input('room_id');
        $checkout = $request->input('checkout');
        $adult_quantity = $request->input('adult_quantity');
        $children_quantity = $request->input('children_quantity');

        $data = [
            'checkIn' => $checkIn,
            'room_id' => $room_id,
            'checkout' => $checkout,
            'adult_quantity' => $adult_quantity,
            'children_quantity' => $children_quantity,
        ];

        $url = route('client.booking', $data);

        return response()->json([
            'type' => 'success',
            'url' => $url
        ]);
    }

    public function booking(Request $request)
    {
        try {
            if (Auth::check()) {
                return redirect()->route('client.login');
            }

            $user_id = $request->user_id;
            $check_in = $request->input('check_in_date');
            $check_out = $request->input('check_out_date');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $address = $request->input('address');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $room_id = $request->input('room_id');
            $payment_type = $request->input('payment_type');
            $voucher = $request->input('voucher_id');
            $discount_price = $request->input('total_price');
            $message = $request->input('message');
            $adult = $request->input('adults_quantity');
            $child = $request->input('children_quantity');

            $today = Carbon::now('Asia/Ho_Chi_Minh')->startOfDay()->timestamp;

            $check_in_timestamp = floor($check_in / 1000);
            $check_out_timestamp = floor($check_out / 1000);

            if ($check_in_timestamp < $today) {
                return response()->json([
                    "type" => "error",
                    "message" => 'Ngày nhận phòng không được nhỏ hơn ngày hôm nay.'
                ], 201);
            }

            if ($check_out_timestamp <= $check_in_timestamp) {
                return response()->json([
                    "type" => "error",
                    "message" => 'Ngày trả phòng không được nhỏ hơn hoặc bằng ngày nhận phòng.'
                ], 201);
            }

            $checkInDate = Carbon::createFromTimestamp($check_in_timestamp, 'Asia/Ho_Chi_Minh');
            $checkOutDate = Carbon::createFromTimestamp($check_out_timestamp, 'Asia/Ho_Chi_Minh');
            $daysBooked = (int)$checkInDate->diffInDays($checkOutDate) + 1;
            $discount_value = null;
            if ($voucher) {
                $v = Voucher::where('id', $voucher)->first();
                $discount_value = $v->discount_value;
            }


            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'phone' => 'required|regex:/^[0-9]{10}$/',
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => 'required|email',
                'check_in_date' => 'required|integer',
                'check_out_date' => 'required|integer',
                'payment_type' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    "type" => "error",
                    "message" => $validator->errors()
                ], 201);
            }

            if ($user_id) {
                $user = User::find($user_id);

                if ($user) {
                    $user->name = $last_name . ' ' . $first_name;
                    $user->first_name = $first_name;
                    $user->last_name = $last_name;
                    $user->address = $address;
                    $user->phone = $phone;
                    $user->save();
                }
            }


            $room = Room::where('id', $room_id)->first();
            if (!$room) {
                return response()->json([
                    "type" => "error",
                    "message" => "Phòng không tồn tại."
                ], 201);
            }

            if ($room->status == 3 || $room->status == 4) {
                return response()->json([
                    "type" => "error",
                    "message" => "Hiện tại không được đặt phòng này."
                ], 201);
            }

            $total_price = $room->price * $daysBooked;
            if ($discount_price) {
                $depositAmount = $discount_price * 0.3;
            } else {
                $depositAmount = $total_price * 0.3;
            }

            $bookings = Booking::where('room_id', $room->id)
                ->where(function ($query) use ($check_in, $check_out) {
                    $query->where(function ($q) use ($check_in, $check_out) {
                        $q->where('check_in_date', '<', $check_out)
                            ->where('check_out_date', '>', $check_in);
                    });
                })
                ->whereIn('status', [1, 2, 3, 4])
                ->exists();

            if ($bookings) {
                return response()->json([
                    "type" => "error",
                    "message" => "Phòng đã có người đặt trước đó."
                ], 201);
            }

            $bookingNumberId = Str::upper(Str::random(5));

            if ($payment_type == 1) {
                $booking = Booking::create([
                    "room_id" => $room_id,
                    'booking_number_id' => $bookingNumberId,
                    "user_id" => $user_id ?? null,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "check_in_date" => $check_in_timestamp,
                    "check_out_date" => $check_out_timestamp,
                    "total_price" => $total_price,
                    "tien_coc" => $depositAmount,
                    "created_at" => Carbon::now('Asia/Ho_Chi_Minh')->timestamp,
                    'voucher_id' => $voucher,
                    'discount_value' => $discount_value,
                    'discount_price' => (int)$discount_price,
                    'message' => $message,
                    'adult' => $adult,
                    'children' => $child
                ]);
            }
            if ($payment_type == 2) {
                $booking = Booking::create([
                    "room_id" => $room_id,
                    'booking_number_id' => $bookingNumberId,
                    "user_id" => $user_id ?? null,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "check_in_date" => $check_in_timestamp,
                    "check_out_date" => $check_out_timestamp,
                    "total_price" => $total_price,
                    "created_at" => Carbon::now('Asia/Ho_Chi_Minh')->timestamp,
                    'voucher_id' => $voucher,
                    'discount_value' => $discount_value,
                    'discount_price' => (int)$discount_price,
                    'message' => $message,
                    'adult' => $adult,
                    'children' => $child
                ]);
            }

            $paymentsIdNumber = Str::upper(Str::random(5));

            $ipAddr = $request->ip();
            if ($payment_type == 1) {
                Payment::create([
                    "payments_id_number" => $paymentsIdNumber,
                    "booking_id" => $booking->id,
                    'total_price' => $depositAmount,
                    "payment_method" => 1,
                ]);
                $order = [
                    "code" => $booking->id,
                    "info" => "booking_payment_$booking->id",
                    "type" => "billpayment",
                    "bankCode" => "NCB",
                    "total" => $depositAmount * 100,
                ];
            }
            if ($payment_type == 2) {
                Payment::create([
                    "payments_id_number" => $paymentsIdNumber,
                    "booking_id" => $booking->id,
                    "total_price" => $booking->discount_price,
                    "payment_method" => 1,
                ]);
                $order = [
                    "code" => $booking->id,
                    "info" => "booking_payment_$booking->id",
                    "type" => "billpayment",
                    "bankCode" => "NCB",
                    "total" => $booking->discount_price * 100,
                ];
            }

            $paymentUrl = $this->paymentController->generatePaymentUrl($order, $ipAddr);

            return response()->json([
                "type" => "success",
                "message" => "Booking successful",
                "data" => $booking,
                "room" => $room,
                "paymentUrl" => $paymentUrl
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

    public function vnpay(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "vnp_Amount" => "required",
                "vnp_BankCode" => "required",
                "vnp_BankTranNo" => "required",
                "vnp_CardType" => "required",
                "vnp_OrderInfo" => "required",
                "vnp_PayDate" => "required",
                "vnp_ResponseCode" => "required",
                "vnp_TmnCode" => "required",
                "vnp_TransactionNo" => "required",
                "vnp_TransactionStatus" => "required",
                "vnp_TxnRef" => "required",
                "vnp_SecureHash" => "required",
            ], $this->messages);

            $vnp_OrderInfo = $_GET['vnp_OrderInfo'];

            $parts = explode("_", $vnp_OrderInfo);

            $id = end($parts);

            if ($validator->fails()) {
                Booking::where('id', $id)->delete();
                Payment::where('booking_id', $id)->delete();
                return response()->json([
                    "type" => "canceled",
                    "message" => "Đã hủy thanh toán!"
                ], 422);
            }

            $validatedData = $validator->validated();

            $vnpBankCode = $request->input('vnp_BankCode');

            unset($validatedData['vnp_BankCode']);

            $paymentGatewayResponse = json_encode($validatedData);

            if ($request->input('vnp_ResponseCode') != 00) {
                return response()->json([
                    "type" => "error",
                    "message" => "Giao dịch không thành công."
                ], 400);
            }

            $booking = Booking::where("id", $id)->first();
            if (!$booking) {
                return response()->json(["message" => "Không tìm thấy đơn hàng"], 404);
            }
            $room = Room::select('id', 'title', 'status')->where("id", $booking->room_id)->first();

            $check_in_code = rand(100000, 999999);
            $booking->code_check_in = $check_in_code;
            if ($booking->tien_coc === NULL) {
                $booking->status = 3;
            }
            if ($booking->tien_coc !== NULL) {
                $booking->status = 2;
            }

            if ($booking->voucher_id) {
                $voucher = Voucher::find($booking->voucher_id);

                if ($voucher) {
                    $voucher->quantity = $voucher->quantity - 1;
                    $voucher->save();
                }
            }
            $booking->save();

            $currentTimestamp = time();

            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('dmY');

            $todayInt = Carbon::createFromFormat('dmY', (string)$today, 'Asia/Ho_Chi_Minh');

            $todayTimestamp = $todayInt->timestamp;

            Payment::where("booking_id", "=", $id)->update([
                'payment_date' => $todayTimestamp,
                "payment_status" => 2,
                "vnp_BankCode" => $vnpBankCode,
                "updated_at" => $currentTimestamp,
                "vnp_TransactionNo" => $paymentGatewayResponse,
            ]);

            $from_new =  (new DateTime())->setTimestamp($booking->check_in_date)->format('Y-m-d');
            $to_new = (new DateTime())->setTimestamp($booking->check_out_date)->format('Y-m-d');

            $status = new ManageStatusRoomController();
            $status->create($id, $booking->room_id, $from_new, $to_new);

            $mail = new MailController();

            $data = [
                'checkin_code' => $check_in_code,
                'check_in_date' => $from_new,
                'check_out_date' => $to_new,
                'name' => $booking->last_name . '' . $booking->first_name
            ];
            $mail->SendCheckinCode("Gửi mã Check in", 'checkincode', $data, $booking->email);

            $title = "Đơn đặt phòng mới";
            $message = "Khách hàng " . $booking->last_name . ' ' . $booking->first_name . " đã đặt phòng " . $room->title . ".";

            $timestamp = $booking->created_at;

            $date = Carbon::createFromTimestamp($timestamp);

            $formattedDate = $date->format('H:i d-m-Y');

            $messageData = [
                "date" => $formattedDate,
                "message" => $message,
                "booking_id" => $booking->id
            ];

            Notification::create([
                "user_id" => Auth::user()->id,
                "title" => $title,
                "message" => json_encode($messageData, JSON_UNESCAPED_UNICODE)
            ]);

            event(new NotificationMessage($message, $title, $formattedDate));
            return redirect()->route('client.detail_booking', $booking->booking_number_id);
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

    public function redirectDetailBooking()
    {
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];

        $parts = explode("_", $vnp_OrderInfo);

        $id = end($parts);

        $booking = Booking::where('id', $id)->first();
        return redirect()->route('client.detail_booking', $booking->booking_number_id);
    }
}
