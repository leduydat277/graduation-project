<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;

class ManageStatusRoomController extends Controller
{

    const VIEW_PATH =  'admin.managestatus.';

    

    public function index(Request $request)
    {
        $title = 'Quản lý trạng thái phòng';

        // Kiểm tra và lấy dữ liệu đầu vào
        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $search = $request->input('search');

        // Xác thực các trường cơ bản
        if (!is_null($status) && !is_numeric($status)) {
            return redirect()->back()->withErrors(['error' => 'Trạng thái không hợp lệ']);
        }

        // Kiểm tra và chuyển đổi `from_date` và `to_date` thành timestamp
        if (!empty($from_date) && !empty($to_date)) {
            try {
                $from = (new DateTime($from_date))->setTime(14, 0, 0)->getTimestamp();
                $to = (new DateTime($to_date))->setTime(12, 0, 0)->getTimestamp();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Ngày không hợp lệ']);
            }
        } else {
            $from = null;
            $to = null;
        }

        // Tạo danh sách phòng thỏa mãn tìm kiếm theo tên
        $room_ids = [];
        if (!empty($search)) {
            $room_ids = Room::where('title', 'like', '%' . $search . '%')->pluck('id')->toArray();
            if (empty($room_ids)) {
                return redirect()->back()->withErrors(['error' => 'Không tìm thấy phòng nào']);
            }
        }

        // Lấy danh sách phòng theo `status` và `room_ids`
        $query = ManageStatusRoom::query();

        if ($status !== null) {
            $query->where('status', $status);
        }

        if (!empty($room_ids)) {
            $query->whereIn('room_id', $room_ids);
        }

        $arr_room_manages = $query->with(['room', 'booking'])->get()->toArray();

        // Kiểm tra và lọc danh sách phòng theo khoảng thời gian
        $results = [];
        foreach ($arr_room_manages as $room) {
            // Nếu cả `from` và `to` đều có giá trị, kiểm tra điều kiện thời gian
            if ($from !== null && $to !== null) {
                // Kiểm tra điều kiện phòng có `to` = 0 và `from` trước ngày người dùng đặt
                if ($room['from'] >= $from && $room['to'] <= $to) {
                    $results[] = $room;
                    continue;
                }

                // Kiểm tra điều kiện người dùng đặt nằm trong khoảng thời gian có sẵn của phòng
                if ($room['from'] >= $from && $to <= $room['to']) {
                    $results[] = $room;
                }
            } else {
                // Nếu không có `from_date` và `to_date`, lấy tất cả các phòng theo `status`
                $results[] = $room;
            }
        }

        // Phân trang kết quả
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentResults = array_slice($results, ($currentPage - 1) * $perPage, $perPage);
        $statusRooms = new LengthAwarePaginator($currentResults, count($results), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view(self::VIEW_PATH . 'index', compact('statusRooms', 'title'));
    }
}
