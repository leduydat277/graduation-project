<?php

namespace App\Http\Controllers\Api;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoucherController
{
    public function checkVoucher(Request $request)
    {
        $voucherCode = $request->input('voucher');
        $voucher = Voucher::where('code_voucher', $voucherCode)->first();

        if (!$voucher) {
            return response()->json([
                'type' => 'error',
                'message' => 'Voucher không tồn tại'
            ], 201);
        }

        if ($voucher->status === 0) {
            return response()->json([
                'type' => 'error',
                'message' => 'Voucher đã dừng hoạt động'
            ], 201);
        }

        if ($voucher->quantity <= 0) {
            return response()->json([
                'type' => 'error',
                'message' => 'Voucher đã hết'
            ], 201);
        }

        $today = now()->timestamp;

        if ($today < $voucher->start_date) {
            return response()->json([
                'type' => 'error',
                'message' => 'Voucher chưa đến thời gian sử dụng.'
            ], 201);
        }

        if ($today > $voucher->end_date) {
            return response()->json([
                'type' => 'error',
                'message' => 'Voucher đã hết hạn sử dụng.'
            ], 201);
        }

        return response()->json([
            'type' => 'success',
            'voucher' => $voucher
        ], 200);
    }
}