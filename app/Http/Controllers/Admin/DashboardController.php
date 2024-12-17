<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AssetType;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

            $todayStart = Carbon::now()->startOfDay()->timestamp;
            $todayEnd = Carbon::now()->endOfDay()->timestamp;

            $bookingToday = Booking::select('id', 'room_id', 'check_in_date', 'check_out_date', 'total_price', 'status', 'created_at')
                ->with('room')
                ->whereBetween('created_at', [$todayStart, $todayEnd])
                ->get();

            $todayPrice = 0;
            $countDes = 0;

            foreach ($bookingToday as $item) {
                if ($item->status == 3) {
                    $todayPrice += $item->total_price;
                }
                if ($item->status == 5) {
                    $countDes++;
                }
            }

            $yearNow = Carbon::now()->format('Y');

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
                'ordersPercentage',
                'yearNow'
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

    public function thongKeTongThe(Request $request)
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if ($startDate && $endDate) {
                $startTimestamp = strtotime($startDate . ' 00:00:00');
                $endTimestamp = strtotime($endDate . ' 23:59:59');

                $successfulBookings = Booking::select('id', 'total_price', 'status', 'created_at')
                    ->where('status', 6)
                    ->whereBetween('created_at', [$startTimestamp, $endTimestamp])
                    ->get();
            } else {
                $successfulBookings = Booking::select('id', 'total_price', 'status', 'created_at')
                    ->where('status', 6)
                    ->get();
            }

            $totalEarnings = $successfulBookings->sum('total_price');
            $totalSuccessfulOrders = $successfulBookings->count();

            $canceledBookings = Booking::select('id', 'total_price', 'status', 'created_at')
                ->where('status', 5)
                ->whereBetween('created_at', [$startTimestamp ?? 0, $endTimestamp ?? time()])
                ->get();

            $totalCanceledOrders = $canceledBookings->count();

            return response()->json([
                "totalEarnings" => $totalEarnings,
                "totalSuccessfulOrders" => $totalSuccessfulOrders,
                "totalCanceledOrders" => $totalCanceledOrders,
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Failed to retrieve statistics",
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
            $bookings = Booking::select('total_price', 'status', 'created_at')
                ->where('status', 6)
                ->get();

            $canceled = Booking::select('status', 'created_at')
                ->where('status', 5)
                ->get();

            $monthlyEarnings = [];
            $monthlyOrders = [];
            $monthlyCanceled = [];
            $totalEarnings = 0;
            $totalOrders = 0;
            $totalCanceled = 0;

            foreach ($bookings as $booking) {
                $monthYear = Carbon::parse($booking->created_at)->format('Y-m');

                if (!isset($monthlyEarnings[$monthYear])) {
                    $monthlyEarnings[$monthYear] = 0;
                }
                $monthlyEarnings[$monthYear] += $booking->total_price;
                $totalEarnings += $booking->total_price;

                if (!isset($monthlyOrders[$monthYear])) {
                    $monthlyOrders[$monthYear] = 0;
                }
                $monthlyOrders[$monthYear]++;
                $totalOrders++;
            }

            foreach ($canceled as $cancel) {
                $monthYear = Carbon::parse($cancel->created_at)->format('Y-m');

                if (!isset($monthlyCanceled[$monthYear])) {
                    $monthlyCanceled[$monthYear] = 0;
                }
                $monthlyCanceled[$monthYear]++;
                $totalCanceled++;
            }

            ksort($monthlyEarnings);
            ksort($monthlyOrders);
            ksort($monthlyCanceled);

            $successRate = 0;
            $cancelRate = 0;

            if ($totalOrders + $totalCanceled > 0) {
                $successRate = ($totalOrders / ($totalOrders + $totalCanceled)) * 100;
                $cancelRate = ($totalCanceled / ($totalOrders + $totalCanceled)) * 100;
            }

            $data = [
                "earnings" => $monthlyEarnings,
                "orders" => $monthlyOrders,
                "canceled" => $monthlyCanceled,
                "totals" => [
                    "total_earnings" => $totalEarnings,
                    "total_orders" => $totalOrders,
                    "total_canceled" => $totalCanceled,
                    "success_rate" => round($successRate, 2),
                    "cancel_rate" => round($cancelRate, 2)
                ]
            ];

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Thống kê thất bại",
                "error" => [
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTrace()
                ]
            ], 500);
        }
    }


    function getWeeksInCurrentMonth()
    {
        try {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;

            $startOfMonth = Carbon::create($year, $month, 1)->startOfDay();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();
            $weeks = [];
            $current = $startOfMonth->copy()->startOfWeek();

            while ($current->lessThanOrEqualTo($endOfMonth)) {
                $weeks[] = [
                    'start' => $current->format('Y-m-d'),
                    'end' => $current->copy()->endOfWeek()->format('Y-m-d'),
                ];
                $current->addWeek();
            }

            $bookings = Booking::select('total_price', 'status', 'created_at')
                ->where('status', 3)
                ->get();

            $weeklyEarnings = [];
            foreach ($weeks as $week) {
                $startOfWeek = Carbon::parse($week['start'])->startOfDay();
                $endOfWeek = Carbon::parse($week['end'])->endOfDay();

                $earnings = $bookings->filter(function ($booking) use ($startOfWeek, $endOfWeek) {
                    $bookingDate = Carbon::createFromTimestamp($booking->created_at);
                    return $bookingDate->between($startOfWeek, $endOfWeek);
                })->sum('total_price');

                $weeklyEarnings[] = [
                    'start' => $week['start'],
                    'end' => $week['end'],
                    'earnings' => $earnings,
                ];
            }

            return response()->json([
                "type" => "success",
                "month" => $month,
                "data" => $weeklyEarnings
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

    function countRoomOrders(Request $request)
    {
        try {
            $roomCounts = Booking::select('room_id', DB::raw('count(*) as count'))
                ->whereIn('status', [2, 3, 4, 6])
                ->groupBy('room_id')
                ->orderByDesc('count')
                ->limit(5)
                ->get();

            $roomIds = $roomCounts->pluck('room_id');

            $rooms = Room::select('id', 'title', 'price', 'thumbnail_image', 'room_type_id')
                ->with('roomType')
                ->whereIn('id', $roomIds)
                ->get()
                ->keyBy('id');

            $roomCounts->transform(function ($room) use ($rooms) {
                $room->room_details = $rooms->get($room->room_id);
                return $room;
            });

            return response()->json([
                "type" => "success",
                "data" => $roomCounts,
                "recordsTotal" => $roomCounts->count(),
                "recordsFiltered" => $roomCounts->count(),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "type" => "error",
                "message" => "Lỗi khi tải dữ liệu phòng",
                "error" => [
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTrace(),
                ]
            ], 500);
        }
    }


    public function getBookingsToday(Request $request)
    {
        $todayStart = Carbon::now()->startOfDay()->timestamp;
        $todayEnd = Carbon::now()->endOfDay()->timestamp;

        $bookingToday = Booking::select('id', 'room_id', 'check_in_date', 'check_out_date', 'total_price', 'status', 'created_at')
            ->with('room')
            ->whereIn('status', [2,3])
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->get();

        $todayPrice = 0;
        $countDes = 0;

        foreach ($bookingToday as $item) {
            if ($item->status == 3) {
                $todayPrice += $item->total_price;
            }
            if ($item->status == 5) {
                $countDes++;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $bookingToday,
            'price' => $todayPrice,
            'count' => $countDes
        ]);
    }

    public function assetsDie(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10);

            $assets = AssetType::select('id', 'name', 'status', 'image')
                ->where('status', 2)
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $assets,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Failed to get assets",
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
