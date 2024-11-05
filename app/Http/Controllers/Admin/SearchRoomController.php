<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SearchRoomController extends Controller
{
    /**
     * Search room for admin
     *
     * @param int $room_type_id  
     * @param int $input_people   
     * @param string $from    
     * @param string $to    
     * 
     * @return array  A list of available rooms that match the criteria.
     */
    public function searchRoom($room_type_id, $input_people, $from, $to)
    {
        // Xác thực dữ liệu đầu vào
        if (!is_numeric($room_type_id) || $room_type_id <= 0) {
            return false;
        }

        if (!is_numeric($input_people) || $input_people <= 0) {
            return false;
        }

        try {
            $fromDate = new DateTime($from);
            $toDate = new DateTime($to);

            // Kiểm tra nếu from và to rơi vào cùng ngày
            if ($fromDate->format('Y-m-d') === $toDate->format('Y-m-d')) {
                return false;
            }

            // check-in: 14h và check-out:12h
            $from = $fromDate->setTime(14, 0, 0)->getTimestamp();
            $to = $toDate->setTime(12, 0, 0)->getTimestamp();
        } catch (\Exception $e) {
            return false;
        }

        // Lấy danh sách phòng với room_type_id, status và sức chứa thỏa mãn
        $arr_rooms = Room::where('room_type_id', $room_type_id)
            ->where('status', 0)
            ->where('max_people', '>=', $input_people)
            ->select('id')
            ->get()
            ->toArray();

        if (empty($arr_rooms)) {
            return false;
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
            // Kiểm tra điều kiện phòng có `to` = 0 và `from` trước ngày người dùng đặt
            if ($room['from'] <= $from && $room['to'] == 0) {
                $results[] = $room['room_id'];
                continue;
            }

            // Kiểm tra điều kiện người dùng đặt nằm trong khoảng thời gian có sẵn của phòng
            if ($room['from'] <= $from && $to <= $room['to']) {
                $results[] = $room['room_id'];
            }
        }

        // Lấy thông tin phòng thỏa mãn điều kiện, bao gồm cả kiểu phòng (room_type)
        if (empty($results)) {
            return false;
        }

        $results_rooms = Room::whereIn('id', $results)
            ->with('roomType')
            ->get()
            ->makeHidden(['room_type_id', 'status', 'room_type']);

        return $results_rooms;
    }


    /**
     * Search room for FE
     *
     * @param int $room_type_id  
     * @param int $input_people   
     * @param string $from   (11-10-2020 or 2020-10-11)
     * @param string $to     (12-10-2020 or 2020-10-12)
     * 
     * @return array A list of available rooms that match the criteria.
     */
    public function apiSearchRoom(Request $request)
    {
        // Validate các tham số đầu vào
        $validated = $request->validate([
            'room_type_id' => 'required|integer',
            'input_people' => 'required|integer|min:1',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
        ]);

        $room_type_id = $validated['room_type_id'];
        $input_people = $validated['input_people'];
        $from = new DateTime($validated['from']);
        $to = new DateTime($validated['to']);

        // Chuyển đổi giờ check-in và check-out
        $from = $from->setTime(14, 0, 0)->getTimestamp();
        $to = $to->setTime(12, 0, 0)->getTimestamp();

        // Lấy các phòng có trạng thái sẵn sàng
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
            // Kiểm tra điều kiện phòng có `to` = 0 và `from` trước ngày người dùng đặt
            if ($room['from'] <= $from && $room['to'] == 0) {
                $results[] = $room['room_id'];
                continue;
            }

            // Kiểm tra điều kiện người dùng đặt nằm trong khoảng thời gian có sẵn của phòng
            if ($room['from'] <= $from && $to <= $room['to']) {
                $results[] = $room['room_id'];
            }
        }

        // Lấy thông tin phòng thỏa mãn điều kiện, bao gồm cả kiểu phòng (room_type)
        if (empty($results)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No available rooms for the selected date range.',
                'code' => 404,
                'data' => null
            ], 404);
        }


        $results_rooms = Room::whereIn('id', $results)
            ->with('roomType')
            ->get()
            ->makeHidden(['room_type_id', 'status', 'room_type']);

        return response()->json([
            'status' => 'success',
            'message' => 'Rooms retrieved successfully.',
            'code' => 200,
            'data' => $results_rooms
        ], 200);
    }
}
