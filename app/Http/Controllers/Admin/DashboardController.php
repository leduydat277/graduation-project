<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController
{
    public function index()
    {
        try {
            // lấy data tuần này
            $startOfWeek = Carbon::now()->startOfWeek()->timestamp;
            $endOfWeek = Carbon::now()->endOfWeek()->timestamp;

            // lấy data tuần trước
            $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek()->timestamp;
            $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek()->timestamp;

            // Lấy data doanh thu và lượt order tuần này
            $bookings = Booking::select('total_price', 'status', 'created_at')
                ->where('status', 3)
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->get();

            $weeklyEarnings = 0;
            $weeklyOrders = 0;

            foreach ($bookings as $booking) {
                $weeklyEarnings += $booking->total_price;
                $weeklyOrders += 1;
            }

            // Lấy data doanh thu và lượt order tuần trước
            $bookingsLastWeek = Booking::select('total_price', 'status', 'created_at')
                ->where('status', 3)
                ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                ->get();

            $weeklyEarningsLastWeek = 0;
            $weeklyOrdersLastWeek = 0;

            foreach ($bookingsLastWeek as $booking) {
                $weeklyEarningsLastWeek += $booking->total_price;
                $weeklyOrdersLastWeek += 1;
            }

            // So sánh doanh thu
            if ($weeklyEarnings > $weeklyEarningsLastWeek) {
                $earningsComparison = 'Tăng';
                $earningsDifference = $weeklyEarnings - $weeklyEarningsLastWeek;
                $earningsPercentage = $weeklyEarningsLastWeek > 0 ? (($earningsDifference) / $weeklyEarningsLastWeek) * 100 : 0;
                $earningsPercentage = round($earningsPercentage, 1);
                if (floor($earningsPercentage) == $earningsPercentage) {
                    $earningsPercentage = (int) $earningsPercentage;
                } else {
                    $earningsPercentage = number_format($earningsPercentage, 1, '.', ',');
                }
            } elseif ($weeklyEarnings < $weeklyEarningsLastWeek) {
                $earningsComparison = 'Giảm';
                $earningsDifference = $weeklyEarningsLastWeek - $weeklyEarnings;
                $earningsPercentage = $weeklyEarningsLastWeek > 0 ? (($earningsDifference) / $weeklyEarningsLastWeek) * 100 : 0;
                $earningsPercentage = round($earningsPercentage, 1);
                if (floor($earningsPercentage) == $earningsPercentage) {
                    $earningsPercentage = (int) $earningsPercentage;
                } else {
                    $earningsPercentage = number_format($earningsPercentage, 1, '.', ',');
                }
            } else {
                $earningsComparison = 'Không thay đổi';
                $earningsDifference = 0;
                $earningsPercentage = 0;
            }

            // So sánh số đơn đặt thành công
            if ($weeklyOrders > $weeklyOrdersLastWeek) {
                $ordersComparison = 'Tăng';
                $ordersDifference = $weeklyOrders - $weeklyOrdersLastWeek;
                $ordersPercentage = $weeklyOrdersLastWeek > 0 ? round((($ordersDifference) / $weeklyOrdersLastWeek) * 100) : 0;
                $ordersPercentage = (int) $ordersPercentage;
            } elseif ($weeklyOrders < $weeklyOrdersLastWeek) {
                $ordersComparison = 'Giảm';
                $ordersDifference = $weeklyOrdersLastWeek - $weeklyOrders;
                $ordersPercentage = $weeklyOrdersLastWeek > 0 ? round((($ordersDifference) / $weeklyOrdersLastWeek) * 100) : 0;
                $ordersPercentage = (int) $ordersPercentage;
            } else {
                $ordersComparison = 'Không thay đổi';
                $ordersDifference = 0;
                $ordersPercentage = 0;
            }


            // Lấy data lượt hủy order tuần này
            $canceled = Booking::select('total_price', 'status', 'created_at')
                ->where('status', 5)
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->get();

            $weeklyCanceled = 0;

            foreach ($canceled as $cancele) {
                $weeklyCanceled += 1;
            }

            // Lấy data lượt hủy order tuần trước
            $canceledLastWeek = Booking::select('total_price', 'status', 'created_at')
                ->where('status', 5)
                ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                ->get();

            $weeklyCanceledLastWeek = 0;

            foreach ($canceledLastWeek as $cancele) {
                $weeklyCanceledLastWeek += 1;
            }

            // So sánh số đơn hủy
            if ($weeklyCanceled > $weeklyCanceledLastWeek) {
                $canceledComparison = 'Tăng';
                $canceledDifference = $weeklyCanceled - $weeklyCanceledLastWeek;
                $canceledPercentage = $weeklyCanceledLastWeek > 0 ? round((($canceledDifference) / $weeklyCanceledLastWeek) * 100) : 0;
                $canceledPercentage = (int) $canceledPercentage;
            } elseif ($weeklyCanceled < $weeklyCanceledLastWeek) {
                $canceledComparison = 'Giảm';
                $canceledDifference = $weeklyCanceledLastWeek - $weeklyCanceled;
                $canceledPercentage = $weeklyCanceledLastWeek > 0 ? round((($canceledDifference) / $weeklyCanceledLastWeek) * 100) : 0;
                $canceledPercentage = (int) $canceledPercentage;
            } else {
                $canceledComparison = 'Không thay đổi';
                $canceledDifference = 0;
                $canceledPercentage = 0;
            }


            $newUsersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

            // Lấy data người dùng mới tham gia tuần trước
            $newUsersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

            // So sánh số người dùng mới tham gia
            if ($newUsersThisWeek > $newUsersLastWeek) {
                $uComparison = 'Tăng';
                $uDifference = $newUsersThisWeek - $newUsersLastWeek;
                $uPercentage = $newUsersLastWeek > 0 ? round((($uDifference) / $newUsersLastWeek) * 100 / 10) : 0;
                $uPercentage = (int) $uPercentage;
            } elseif ($newUsersThisWeek < $newUsersLastWeek) {
                $uComparison = 'Giảm';
                $uDifference = $newUsersLastWeek - $newUsersThisWeek;
                $uPercentage = $newUsersLastWeek > 0 ? round((($uDifference) / $newUsersLastWeek) * 100 / 10) : 0;
                $uPercentage = (int) $uPercentage;
            } else {
                $uComparison = 'Không thay đổi';
                $uDifference = 0;
                $uPercentage = 0;
            }

            return view('admin.dashboard.index', compact([
                'weeklyEarnings',
                'weeklyOrders',
                'weeklyCanceled',
                'newUsersThisWeek',
                'uComparison',
                'uPercentage',
                'canceledComparison',
                'canceledPercentage',
                'earningsComparison',
                'earningsPercentage',
                'ordersComparison',
                'ordersPercentage'
            ]));
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

    public function statistical()
    {
        try {
            $bookings = Booking::select('total_price', 'status', 'created_at')->where('status', 3)->get();
            $monthlyEarnings = [];
            $monthlyOrders = [];
            $canceled = Booking::select('total_price', 'status', 'created_at')->where('status', 5)->get();
            $monthlyCanceled = [];

            foreach ($bookings as $booking) {
                $monthYear = Carbon::createFromTimestamp($booking->created_at)->format('Y-m');

                if (!isset($monthlyEarnings[$monthYear])) {
                    $monthlyEarnings[$monthYear] = 0;
                }
                $monthlyEarnings[$monthYear] += $booking->total_price;

                if (!isset($monthlyOrders[$monthYear])) {
                    $monthlyOrders[$monthYear] = 0;
                }
                $monthlyOrders[$monthYear] += 1;
            }

            ksort($monthlyEarnings);
            ksort($monthlyOrders);
            ksort($monthlyCanceled);

            foreach ($canceled as $cancele) {
                $monthYear = Carbon::createFromTimestamp($cancele->created_at)->format('Y-m');

                if (!isset($monthlyCanceled[$monthYear])) {
                    $monthlyCanceled[$monthYear] = 0;
                }
                $monthlyCanceled[$monthYear] += 1;
            }

            $data = [
                "earnings" => $monthlyEarnings,
                "orders" => $monthlyOrders,
                "canceled" => $monthlyCanceled
            ];

            return response()->json($data, 200);
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
