<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController
{
    public function allPayments()
    {
        // $user = Auth::user();
        $user = 10;
        $payments = Payment::with([
            'booking' => function ($query) {
                $query->select('id', 'tien_coc as tiencoc', 'total_price as tienphong', 'status as status');
            },
            'booking.phiphatsinhs' => function ($query) {
                $query->select('id', 'booking_id', 'name', 'price');
            }
        ])
            ->whereHas('booking', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->get()
            ->groupBy('booking.id')
            ->map(function ($paymentGroup) {
                $totalAmount = $paymentGroup->sum('total_price');
                $paymentCount = $paymentGroup->count();
                $paymentPrices = $paymentGroup->pluck('total_price');
                $phiphatsinhs = $paymentGroup->first()->booking->phiPhatSinhs->map(function ($item) {
                    return [
                        'dichvuphatsinh' => $item->name,
                        'tienphatsinh' => $item->price
                    ];
                });
                $paymentStatusLabel = '';
                switch ($paymentGroup->first()->payment_status) {
                    case 0:
                        $paymentStatusLabel = 'Chưa thanh toán cọc';
                        break;
                    case 1:
                        $paymentStatusLabel = 'Đang thanh toán';
                        break;
                    case 2:
                        $paymentStatusLabel = 'Đã thanh toán cọc';
                        break;
                    case 3:
                        $paymentStatusLabel = 'Đã thanh toán tổng tiền đơn';
                        break;
                    case 4:
                        $paymentStatusLabel = 'Đã hủy';
                        break;
                    default:
                        $paymentStatusLabel = 'Không xác định';
                }
                return [
                    'tongtiendathanhtoan' => $totalAmount,
                    'solanthanhtoan' => $paymentCount,
                    'tiencoc' => $paymentGroup->first()->booking->tiencoc ?? null,
                    'tienphong' => $paymentGroup->first()->booking->tienphong ?? null,
                    'phiphatsinh' => $phiphatsinhs,
                    'trangthai' => $paymentStatusLabel ?? null,
                    'sotienmoilanthanhtoan' => $paymentPrices,
                ];
            });
            if ($payments->isEmpty()) {
                return response()->json([
                    "code" => 401,
                    "message" => "Bạn chưa có hóa đơn nào!",
                ]);
            }
        return response()->json([
            "code" => 200,
            "message" => "Get success",
            "data" => $payments
        ]);
    }

    public function filterPayments()
    {
        $fromDate = strtotime(request()->input('fromDate', '')); 
        $toDate = strtotime(request()->input('toDate', ''));      
        if (!$fromDate || !$toDate) {
            return response()->json([
                "code" => 400,
                "message" => "Vui lòng nhập theo định dạng d-M-Y",
            ]);
        }
        // $user = Auth::user();
        $user = 10; 
        $payments = Payment::with([
            'booking' => function ($query) {
                $query->select('id', 'tien_coc as tiencoc', 'total_price as tienphong', 'status as status');
            },
            'booking.phiphatsinhs' => function ($query) {
                $query->select('id', 'booking_id', 'name', 'price');
            }
        ])
            ->whereHas('booking', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            ->whereBetween('payment_date', [$fromDate, $toDate])  
            ->get()
            ->groupBy('booking.id')
            ->map(function ($paymentGroup) {
                $totalAmount = $paymentGroup->sum('total_price'); 
                $paymentCount = $paymentGroup->count();  
                $paymentPrices = $paymentGroup->pluck('total_price');  
                $phiphatsinhs = $paymentGroup->first()->booking->phiPhatSinhs->map(function ($item) {
                    return [
                        'dichvuphatsinh' => $item->name,
                        'tienphatsinh' => $item->price
                    ];
                });
                $paymentStatusLabel = '';
                switch ($paymentGroup->first()->payment_status) {
                    case 0:
                        $paymentStatusLabel = 'Chưa thanh toán cọc';
                        break;
                    case 1:
                        $paymentStatusLabel = 'Đang thanh toán';
                        break;
                    case 2:
                        $paymentStatusLabel = 'Đã thanh toán cọc';
                        break;
                    case 3:
                        $paymentStatusLabel = 'Đã thanh toán tổng tiền đơn';
                        break;
                    case 4:
                        $paymentStatusLabel = 'Đã hủy';
                        break;
                    default:
                        $paymentStatusLabel = 'Không xác định';
                }
                return [
                    'tongtiendathanhtoan' => $totalAmount,  
                    'solanthanhtoan' => $paymentCount,  
                    'tiencoc' => $paymentGroup->first()->booking->tiencoc ?? null, 
                    'tienphong' => $paymentGroup->first()->booking->tienphong ?? null, 
                    'phiphatsinh' => $phiphatsinhs,
                    'trangthai' => $paymentStatusLabel, 
                    'sotienmoilanthanhtoan' => $paymentPrices,  
                ];
            });
            if($payments->isEmpty()) {
                return response()->json([
                    "code" => 401,
                    "message" => "Không tìm thấy hóa đơn nào!",
                ]);
            }
        return response()->json([
            "code" => 200,
            "message" => "Filter success",
            "data" => $payments
        ]);
    }
}
