<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentControllers extends Controller
{
    protected $vnpayPayment;

    public function __construct(PaymentController $vnpayPayment)
    {
        $this->vnpayPayment = $vnpayPayment;
    }

    public function bookings(Request $request)
    {
        $id = 1;
        $price = 50000;
        $order = [
            "code" => $id,
            "info" => "order_payment_$id",
            "type" => "billpayment",
            "bankCode" => "NCB",
            "total" => $price,
        ];
        $ipAddr = $request->ip();
        $urlReturn = $this->vnpayPayment->generatePaymentUrl($order, $ipAddr, "http://127.0.0.1:8001/");
        return response()->json(["url" => $urlReturn], 200);
    }
}
