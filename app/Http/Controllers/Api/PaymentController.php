<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController
{
    public function allPayments()
    {
        $user = Auth::user();
        return response()->json([
            "code" => 200,
            "message" => "Get success",
            "data" => $user
        ]);
        $payments = Payment::all();
        $data = $payments->map(function ($payment) {
            return [
                'id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'payment_date' => $payment->payment_date,
                'total_price' => $payment->total_price,
            ];
        });
        return response()->json([
            "code" => 200,
            "message" => "Get success",
            "data" => $data
        ]);
    }

    public function filterPayments(){
        $fromDate = strtotime(request()->input('fromDate'));
        $toDate = strtotime(request()->input('toDate'));
        $payments = Payment::whereBetween('payment_date', [$fromDate, $toDate])->get();

        return response()->json([
            "code" => 200,
            "message" => "Filter success",
            "data" => $payments
        ]);
    }
}
