<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use Carbon\Carbon;
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
    public function searchRoom($room_type_id, $input_people, $from, $to, $room_id)
    {
        if (!$room_id && (!is_numeric($input_people) || $input_people <= 0)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input for number of people.',
            ], 400);
        }

        // try {
        if ($from != "null" && $to != "null") {
            $fromDate = new DateTime($from);
            $toDate = new DateTime($to);

            // Kiểm tra nếu from và to rơi vào cùng ngày
            if ($fromDate->format('Y-m-d') === $toDate->format('Y-m-d')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid date range.',
                ], 400);
            }

            $fromTimestamp = $fromDate->setTime(14, 0, 0)->getTimestamp();
            $toTimestamp = $toDate->setTime(12, 0, 0)->getTimestamp();
        } else {
            $fromTimestamp = null;
            $toTimestamp = null;
        }

        //TODO Trường hợp nếu `room_id` được truyền
        if ($room_id && $room_id != "null") {
            $current_time_room = ManageStatusRoom::select('room_id', 'from', 'to')
                ->where('room_id', $room_id)
                ->where('status', 1)
                ->where(function ($query) use ($fromTimestamp, $toTimestamp) {
                    if ($fromTimestamp && $toTimestamp) {
                        // Điều kiện khi có input from và to
                        $query->where('from', '<=', $fromTimestamp)
                            ->where(function ($query) use ($toTimestamp) {
                                // Kiểm tra nếu `to = 0`, không so sánh thời gian kết thúc
                                $query->where('to', '>=', $toTimestamp)
                                    ->orWhere('to', 0);  // Nếu `to = 0` thì coi như không giới hạn
                            });
                    } else {
                        // Điều kiện khi không có from và to
                        $query->where('from', '>=', Carbon::now()->timestamp);
                    }
                })
                ->get()
                ->toArray();

            if (empty($current_time_room)) {
                return response()->json([
                    'message' => 'No available rooms found.',
                    'status' => 'error'
                ], 404);
            }

            foreach ($current_time_room as &$item_arr) {
                $item_arr['from'] = (new DateTime())->setTimestamp($item_arr['from'])->format('d-m-Y');
                $item_arr['to'] = (new DateTime())->setTimestamp($item_arr['to'])->format('d-m-Y');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Rooms retrieved successfully.',
                'code' => 200,
                'data' => $current_time_room
            ], 200);
        }

        // Tìm phòng với các tiêu chí đã được lọc
        $arr_rooms = Room::where('room_type_id', $room_type_id)
            ->where('max_people', '>=', $input_people)
            ->select('id')
            ->get()
            ->toArray();

        if (empty($arr_rooms)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No rooms available for the given capacity.',
            ], 404);
        }

        // Lấy danh sách trạng thái phòng dựa trên bảng "manage_status_rooms"
        $arr_room_manages = [];
        foreach ($arr_rooms as $room) {
            $records_manage = ManageStatusRoom::where('room_id', $room['id'])
                ->where('status', 1)
                ->where('from', '>=', Carbon::now())
                ->get()
                ->toArray();

            if (!empty($records_manage)) {
                $arr_room_manages = array_merge($arr_room_manages, $records_manage);
            }
        }

        $results = [];
        foreach ($arr_room_manages as $room) {
            // Kiểm tra điều kiện phòng có to = 0 và from trước ngày người dùng đặt
            if ($room['from'] <= $fromTimestamp && $room['to'] == 0) {
                $results[] = $room['room_id'];
                continue;
            }

            if ($room['from'] <= $fromTimestamp && $toTimestamp <= $room['to']) {
                $results[] = $room['room_id'];
            }
        }

        // Kiểm tra và trả về phòng thỏa mãn
        if (empty($results)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No rooms available for the selected dates.',
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
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'An error occurred while processing your request.',
        //     ], 500);
        // }
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
            'room_type_id' => 'nullable|integer',
            'room_id' => 'nullable|integer',
            'input_people' => 'nullable|integer|min:1',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
        ]);

        $room_type_id = $validated['room_type_id'];
        $room_id = $validated['room_id'];
        $input_people = $validated['input_people'];
        $from = new DateTime($validated['from']);
        $to = new DateTime($validated['to']);

        // Chuyển đổi giờ check-in và check-out
        $from = $from->setTime(14, 0, 0)->getTimestamp();
        $to = $to->setTime(12, 0, 0)->getTimestamp();

        if ($room_id != null) {
            $current_time_room = ManageStatusRoom::select('room_id', 'from', 'to')
                ->where('room_id', $room_id)
                ->where('status', 1)
                ->get()->toArray();

            if (empty($current_time_room)) {
                return response()->json([
                    'message' => 'Không tìm thấy thời gian trống nào',
                    'status' => false
                ], 404);
            }

            foreach ($current_time_room as &$item_arr) {
                $item_arr['from'] = (new DateTime())->setTimestamp($item_arr['from'])->format('m-d-Y');
                $item_arr['to'] = (new DateTime())->setTimestamp($item_arr['to'])->format('m-d-Y');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Rooms retrieved successfully.',
                'code' => 200,
                'data' => $current_time_room
            ], 200);
        }

        // Lấy các phòng có trạng thái sẵn sàng
        $arr_rooms = Room::where('room_type_id', $room_type_id)
            // ->where('status', 0)
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