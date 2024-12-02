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
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('dmY');

            $todayInt = Carbon::createFromFormat('dmY', (string)$today, 'Asia/Ho_Chi_Minh');
            $checkInDate = Carbon::createFromFormat('dmY', (string)$check_in_date);
            $checkOutDate = Carbon::createFromFormat('dmY', (string)$check_out_date);
 
            $checkInDateFormat = Carbon::createFromFormat('dmY', (string)$check_in_date)->setTime(14, 0, 0);
            $checkOutDateFormat = Carbon::createFromFormat('dmY', (string)$check_out_date)->setTime(12, 0, 0);

            $todayTimestamp = $todayInt->timestamp;
            $checkInTimestamp = $checkInDateFormat->timestamp;
            $checkOutTimestamp = $checkOutDateFormat->timestamp;

            $daysBooked = $checkInDate->diffInDays($checkOutDate);

            $validator = Validator::make($request->all(), [
                'address' => 'required',
                'phone' => 'required|regex:/^[0-9]{10}$/',
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => 'required|email',
                'check_in_date' => 'required',
                'check_out_date' => 'required',
            ], $this->messages);

            if ($validator->fails()) {
                return response()->json([
                    "type" => "error",
                    "message" => $validator->errors()
                ], 400);
            }

            if ($checkInDate < $todayInt) {
                return response()->json([
                    "type" => "error",
                    "message" => 'Ngày nhận phòng không được nhỏ hơn ngày hôm nay.'
                ], 400);
            }

            if ($checkOutDate <= $checkInDate) {
                return response()->json([
                    "type" => "error",
                    "message" => 'Ngày trả phòng không được nhỏ hơn ngày nhận phòng.'
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
            $total_price = $room->price * $daysBooked;
            $depositAmount = $total_price * 0.3;

            $bookings = Booking::select('room_id', 'check_in_date', 'check_out_date', 'status')
                ->where('room_id', $room->id)
                ->get();

            foreach ($bookings as $booking) {

                if (($checkInTimestamp >= $booking->check_in_date
                        && $checkInTimestamp < $booking->check_out_date)
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
                    "check_in_date" => $checkInTimestamp,
                    "check_out_date" => $checkOutTimestamp,
                    "total_price" => $total_price,
                    "tien_coc" => $depositAmount,
                    "created_at" => $todayTimestamp
                ]);
            } else {
                $booking = Booking::create([
                    "room_id" => $room_id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "check_in_date" => $checkInTimestamp,
                    "check_out_date" => $checkOutTimestamp,
                    "total_price" => $total_price,
                    "tien_coc" => $depositAmount,
                    "created_at" => $todayTimestamp
                ]);
            }
            Payment::create([
                "booking_id" => $booking->id,
                "total_price" => $depositAmount,
                "payment_method" => 1,
            ]);

            $ipAddr = $request->ip();
            $order = [
                "code" => $booking->id,
                "info" => "booking_payment_$booking->id",
                "type" => "billpayment",
                "bankCode" => "NCB",
                "total" => $depositAmount * 100,
            ];

            $paymentUrl = $this->paymentController->generatePaymentUrl($order, $ipAddr);

            return response()->json([
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

            $id = $request->input('vnp_TxnRef');

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

            $booking = Booking::where("id", $id)->first();
            if (!$booking) {
                return response()->json(["message" => "Không tìm thấy đơn hàng"], 404);
            }
            $room = Room::select('id', 'title')->where("id", $booking->room_id)->first();

            $check_in_code = rand(100000, 999999);
            $booking->code_check_in = $check_in_code;
            $booking->status = 2;
            $booking->save();

            $currentTimestamp = time();
            Payment::where("booking_id", "=", $id)->update([
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
                "user_id" => 1,
                "title" => $title,
                "message" => json_encode($messageData, JSON_UNESCAPED_UNICODE)
            ]);

            event(new NotificationMessage($message, $title, $formattedDate));
            return response()->json([
                "url_redirect" => "url_test",
                "message" => "Thanh toán thành công"
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
