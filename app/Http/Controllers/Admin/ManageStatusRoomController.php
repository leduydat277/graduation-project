<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ManageStatusRoomController extends Controller
{

    const VIEW_PATH =  'admin.managestatus.';
    public function index(Request $request)
    {
        $title = 'Quản lý trạng thái phòng';

        // Lấy dữ liệu đầu vào
        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $search = $request->input('search');

        // Xác thực các trường cơ bản
        if (!is_null($status) && !is_numeric($status)) {
            return redirect()->back()->withErrors(['error' => 'Trạng thái không hợp lệ']);
        }

        // Chuyển đổi `from_date` và `to_date` thành timestamp
        $from = $to = null;
        try {
            if (!empty($from_date)) {
                $from = (new DateTime($from_date))->setTime(0, 0, 0)->getTimestamp();
            }
            if (!empty($to_date)) {
                $to = (new DateTime($to_date))->setTime(23, 59, 59)->getTimestamp();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ngày không hợp lệ']);
        }

        // Tìm kiếm phòng theo `id`, `title`, hoặc `room_code`
        $room_ids = [];
        if (!empty($search)) {
            $room_ids = Room::where('id', $search)
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('roomId_number', 'like', '%' . $search . '%')
                ->pluck('id')
                ->toArray();

            if (empty($room_ids)) {
                return redirect()->back()->withErrors(['error' => 'Không tìm thấy phòng nào']);
            }
        }

        // Xây dựng query cho `ManageStatusRoom`
        $query = ManageStatusRoom::query()->with(['room.roomType', 'booking']);

        if ($status !== null) {
            $query->where('status', $status);
        }

        if (!empty($room_ids)) {
            $query->whereIn('room_id', $room_ids);
        }

        // Loại bỏ các bản ghi có `to` = 0
        $query->where('to', '>', 0);

        // Lọc theo khoảng thời gian nằm hoàn toàn trong khoảng đã chọn
        if ($from !== null && $to !== null) {
            $query->where('from', '>=', $from)
                ->where('to', '<=', $to);
        } elseif ($from !== null) {
            $query->where('from', '>=', $from);
        } elseif ($to !== null) {
            $query->where('to', '<=', $to);
        }

        // dd($query->toSql(), $query->getBindings()); // Debug query nếu cần

        // Phân trang kết quả
        $statusRooms = $query->paginate(10);

        return view(self::VIEW_PATH . 'index', compact('statusRooms', 'title'));
    }


    public function create($id_booking, $id_room, $from, $to)
    {
        $from_new = (new DateTime($from))->setTime(14, 0, 0)->getTimestamp();
        $to_new = (new DateTime($to))->setTime(12, 0, 0)->getTimestamp();

        $current_time_room = ManageStatusRoom::where('room_id', $id_room)
            ->where('status', 1)
            ->where('from', '<=', $from_new)
            ->where('to', '>=', $to_new)
            ->first();

        if ($current_time_room && $to_new == $current_time_room->to && $from == $current_time_room->from) {
            $current_time_room->update([
                'booking_id' => $id_booking,
                'status' => 0
            ]);
            return;
        }

        ManageStatusRoom::create([
            "booking_id" => $id_booking,
            "room_id" => $id_room,
            "status" => 0,
            "from" => $from_new,
            "to" => $to_new
        ]);

        if ($current_time_room) {
            if ($from_new > $current_time_room->from) {
                $new_record_manage_from = (new DateTime())->setTimestamp($current_time_room->from)->setTime(14, 0, 0)->getTimestamp();
                $new_record_manage_to = (new DateTime())->setTimestamp($from_new)->setTime(12, 0, 0)->getTimestamp();

                ManageStatusRoom::create([
                    "room_id" => $id_room,
                    "status" => 1,
                    "from" => $new_record_manage_from,
                    "to" => $new_record_manage_to
                ]);
            }
            if ($to_new < $current_time_room->to) {
                $new_record_manage_from = (new DateTime($to))->setTime(14, 0, 0)->getTimestamp();
                $new_record_manage_to = (new DateTime())->setTimestamp($current_time_room->to)->setTime(12, 0, 0)->getTimestamp();

                ManageStatusRoom::create([
                    "room_id" => $id_room,
                    "status" => 1,
                    "from" => $new_record_manage_from,
                    "to" => $new_record_manage_to
                ]);
            }
            if ($current_time_room) {
                $current_time_room->delete();
            }
        } else {
            $current_room_future = ManageStatusRoom::where('room_id', $id_room)->where('to', 0)->first();
            if ($from_new >= $current_room_future->from) {
                $new_record_manage_from = (new DateTime())->setTimestamp($current_room_future->from)->setTime(14, 0, 0)->getTimestamp();
                $new_record_manage_to = (new DateTime($from))->setTime(12, 0, 0)->getTimestamp();

                if ($from_new != $current_room_future->from) {
                    ManageStatusRoom::create([
                        "room_id" => $id_room,
                        "status" => 1,
                        "from" => $new_record_manage_from,
                        "to" => $new_record_manage_to
                    ]);
                }

                $new_record_future_from = (new DateTime($to))->setTime(14, 0, 0)->getTimestamp();
                $new_record_future_to = 0;

                ManageStatusRoom::where('room_id', $id_room)->where('to', 0)->delete();
                ManageStatusRoom::create([
                    "room_id" => $id_room,
                    "status" => 1,
                    "from" => $new_record_future_from,
                    "to" => $new_record_future_to
                ]);
            }
        }

        return 'Thêm bản ghi vào bảng Manage Status Room thành công';
    }
}
