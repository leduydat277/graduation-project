<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SearchRoomController extends Controller
{
    public function searchRoom($room_type_id, $input_people, $date_in, $date_out)
    {
        // Xác thực dữ liệu đầu vào
        if (!is_numeric($room_type_id) || $room_type_id <= 0) {
            return response()->json(['error' => 'room_type_id phải là một số nguyên dương.'], 400);
        }

        if (!is_numeric($input_people) || $input_people <= 0) {
            return response()->json(['error' => 'input_people phải là một số nguyên dương.'], 400);
        }

        try {
            // Chuyển đổi chuỗi ngày tháng thành timestamp với giờ cố định
            $date_in = (new DateTime($date_in))->setTime(14, 0, 0)->getTimestamp();
            $date_out = (new DateTime($date_out))->setTime(12, 0, 0)->getTimestamp();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Định dạng ngày không hợp lệ.'], 400);
        }

        // Lấy danh sách phòng với room_type_id, status và sức chứa thỏa mãn
        $arr_rooms = Room::where('room_type_id', $room_type_id)
            ->where('status', 0)
            ->where('max_people', '>=', $input_people)
            ->select('id')
            ->get()
            ->toArray();

        if (empty($arr_rooms)) {
            return response()->json(['error' => 'Không có phòng nào thỏa mãn điều kiện.'], 404);
        }

        // Lấy thời gian quản lý phòng từ "manage_status_room"
        $arr_room_manages = [];
        foreach ($arr_rooms as $room) {
            $records_manage = ManageStatusRoom::where('room_id', $room['id'])
                ->where('status', 1)
                ->get()
                ->toArray();

            if (!empty($records_manage)) {
                $arr_room_manages = array_merge($arr_room_manages, $records_manage);
            }
        }

        // Kiểm tra thời gian đặt của người dùng với danh sách phòng lấy được
        $results = [];
        foreach ($arr_room_manages as $room) {
            // Kiểm tra điều kiện phòng có `date_out` = 0 và `date_in` trước ngày người dùng đặt
            if ($room['from'] <= $date_in && $room['to'] == 0) {
                $results[] = $room['room_id'];
                continue;
            }

            // Kiểm tra điều kiện người dùng đặt nằm trong khoảng thời gian có sẵn của phòng
            if ($room['from'] <= $date_in && $date_out <= $room['to']) {
                $results[] = $room['room_id'];
            }
        }

        // Lấy thông tin phòng thỏa mãn điều kiện, bao gồm cả kiểu phòng (room_type)
        if (empty($results)) {
            return response()->json(['error' => 'Không có phòng nào trống trong khoảng thời gian đã chọn.'], 404);
        }

        $results_rooms = Room::whereIn('id', $results)
            ->with('roomType')
            ->get();

        return $results_rooms;
    }

    public function apiSearchRoom(Request $request)
    {
        // Validate các tham số đầu vào
        $validated = $request->validate([
            'room_type_id' => 'required|integer',
            'input_people' => 'required|integer|min:1',
            'date_in' => 'required|date',
            'date_out' => 'required|date|after:date_in',
        ]);

        $room_type_id = $validated['room_type_id'];
        $input_people = $validated['input_people'];
        $date_in = new DateTime($validated['date_in']);
        $date_out = new DateTime($validated['date_out']);

        // Chuyển đổi giờ check-in và check-out
        $date_in = $date_in->setTime(14, 0, 0)->getTimestamp();
        $date_out = $date_out->setTime(12, 0, 0)->getTimestamp();

        // Lấy các phòng có trạng thái sẵn sàng
        $arr_rooms = Room::where('room_type_id', $room_type_id)
            ->where('status', 0)
            ->where('max_people', '>=', $input_people)
            ->select('id')
            ->get()
            ->toArray();

        if (!$arr_rooms) {
            return response()->json(['message' => 'No rooms available'], 404);
        }

        // Kiểm tra khung giờ phòng
        $arr_room_manages = [];
        foreach ($arr_rooms as $room) {
            $records_manage = ManageStatusRoom::where('room_id', $room['id'])
                ->where('status', 1)
                ->get()
                ->toArray();

            if (!empty($records_manage)) {
                $arr_room_manages = array_merge($arr_room_manages, $records_manage);
            }
        }

        // Lọc danh sách phòng theo thời gian đặt
        $results = [];
        foreach ($arr_room_manages as $room) {
            if ($room['from'] <= $date_in && $room['to'] == 0) {
                $results[] = $room['room_id'];
                continue;
            }

            if ($room['from'] <= $date_in && $date_out <= $room['to']) {
                $results[] = $room['room_id'];
            }
        }

        // Lấy thông tin phòng và loại phòng
        $results_rooms = Room::whereIn('id', $results)
            ->with('roomType')
            ->get();

        return response()->json($results_rooms);
    }
}
