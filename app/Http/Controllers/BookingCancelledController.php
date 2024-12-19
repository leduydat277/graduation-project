<?php

namespace App\Http\Controllers;

use App\Events\NotificationMessage;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\ManageStatusRoomController;
use App\Jobs\SendEmail;
use App\Models\Booking;
use App\Models\BookingCancelled;
use App\Models\ManageStatusRoom;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\Reson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BookingCancelledController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reson = Reson::all();
        $view = view('client.cancelModal', compact('reson'))->render();
        return response()->json([
            'type' => 'success',
            'view' => $view,
        ]);
    }

    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bookingId = $request->input('bookingId');
        $today = Carbon::now();

        $booking = Booking::where('id', $bookingId)->first();
        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 201);
        }

        if ($booking->status == 5) {
            return response()->json([
                'type' => 'error',
                'message' => 'Phòng này đã được hủy rồi'
            ]);
        }

        $reson = Reson::where('id', $request->input('reason_id'))->first();
        if (!$reson) {
            return response()->json(['error' => 'Reason not found'], 201);
        }

        $createdAt = Carbon::createFromTimestamp($booking->created_at);
        $checkInTime = Carbon::createFromTimestamp($booking->check_in_date);

        $refundAmount = 0;

        if ($today->diffInMinutes($createdAt) <= 60) {
            $refundAmount = '100';
        } elseif ($today->diffInMinutes($createdAt) > 60 && $today->lt($checkInTime->setTime(12, 0, 0))) {
            $refundAmount = '50';
        } elseif ($today->gte($checkInTime->setTime(12, 0, 0))) {
            $refundAmount = '0';
        }

        ManageStatusRoomController::cancel($bookingId);

        $booking->status = 5;
        $booking->save();

        if ($refundAmount = '100' || $refundAmount = '50') {
            BookingCancelled::create([
                'booking_id' => $bookingId,
                'reason' => $reson->reson,
                'description' => $request->input('description'),
                'refund' => $refundAmount,
                'cancelled_at' => $today->timestamp
            ]);
        } else {
            BookingCancelled::create([
                'booking_id' => $bookingId,
                'reason' => $reson->reson,
                'description' => $request->input('description'),
                'refund' => $refundAmount,
                'cancelled_at' => $today->timestamp,
                "status" => 'approved'
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => 'Bạn đã hủy thành công'
        ], 200);
    }

    public function index_admin(Request $request)
    {
        if ($request->ajax()) {
            $query = BookingCancelled::with('booking')->whereHas('booking', function ($subQuery) {
                $subQuery->where('status', 5);
            });

            // Lọc theo status nếu có yêu cầu
            if ($request->has('status') && $request->status) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
                ->addColumn('refund_badge', function ($row) {
                    if (!$row->booking) {
                        return '<span class="badge bg-secondary">Không có dữ liệu</span>';
                    }

                    try {
                        $cancelledAt = is_numeric($row->cancelled_at)
                            ? Carbon::createFromTimestamp($row->cancelled_at)
                            : null;

                        Log::error('can: ' . $cancelledAt);

                        $createdAt = is_numeric($row->booking->created_at)
                            ? Carbon::createFromTimestamp($row->booking->created_at)
                            : null;

                        Log::error('crea: ' . $createdAt);

                        $checkInDate = is_numeric($row->booking->check_in_date)
                            ? Carbon::createFromTimestamp($row->booking->check_in_date)->setTime(12, 0, 0) // Gán giờ là 12:00
                            : null;

                        Log::error($checkInDate);

                        $timeDiff = $createdAt->diffInMinutes($cancelledAt);

                        // if (!$cancelledAt || !$createdAt || !$checkInDate) {
                        //     return '<span class="badge bg-secondary">Không xác định</span>';
                        // }

                        if ($timeDiff <= 60) {
                            return '<span class="badge bg-success">100%</span>';
                        } else if ($cancelledAt->lt($checkInDate->copy()->subHours(12))) {
                            return '<span class="badge bg-warning">50%</span>';
                        } else {
                            return '<span class="badge bg-danger">0%</span>';
                        }
                    } catch (\Exception $e) {
                        // Xử lý ngoại lệ nếu dữ liệu không hợp lệ
                        return '<span class="badge bg-secondary">Lỗi dữ liệu</span>';
                    }
                })
                ->addColumn('status_badge', function ($row) {
                    switch ($row->status) {
                        case 'pending':
                            return '<span class="badge bg-warning">Đang chờ</span>';
                        case 'approved':
                            return '<span class="badge bg-success">Đã duyệt</span>';
                        case 'rejected':
                            return '<span class="badge bg-danger">Bị từ chối</span>';
                        default:
                            return '<span class="badge bg-secondary">Không xác định</span>';
                    }
                })
                ->rawColumns(['refund_badge', 'status_badge'])
                ->make(true);
        }

        return view('admin.cancel.index');
    }

    public function confirm($id)
    {
        $cancel = BookingCancelled::where('id', $id)->first();
        if (!$cancel) {
            return redirect()->route('cancel.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $cancel->status = 'approved';
        $cancel->save();

        $booking = Booking::where('id', $cancel->booking_id)->first();

        $check_in_code = rand(100000, 999999);

        $data = [
            'code_hoan_tien' => $check_in_code,
            'name' => $booking->last_name . '' . $booking->first_name
        ];
        SendEmail::dispatch($data, 'cancel', 'Yêu cầu hủy phòng được chấp nhận', $booking->email);

        return redirect()->route('cancel.index')->with('success', 'Mail chấp nhận hủy phòng đã được gửi đến khách hàng.');
    }
}
