<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use Carbon\Carbon;
use DateTime;
use Exception;
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
    public function searchRoom()
    {

        $room_type_id = $_GET['room_type_id'] ?? null;
        $input_people = $_GET['quantity'] ?? null;
        $from = $_GET['select-arrival-date_value'] ?? null;
        $to = $_GET['select-departure-date_value'] ?? null;

        if ($from && $to) {
            try {
                $fromDate = new DateTime($from);
                $toDate = new DateTime($to);

                if ($fromDate->format('Y-m-d') === $toDate->format('Y-m-d')) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid date range. Check-in and check-out dates cannot be the same.',
                    ], 400);
                }

                $fromTimestamp = $fromDate->setTime(14, 0, 0)->getTimestamp();
                $toTimestamp = $toDate->setTime(12, 0, 0)->getTimestamp();
                // dd($fromDate->setTime(14, 0, 0), $toDate->setTime(12, 0, 0));
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid date format.',
                ], 400);
            }
        } else {
            $fromTimestamp = Carbon::now()->timestamp;
            $toTimestamp = $fromTimestamp + 86400;
        }

        $query = Room::query();

        $query->where('status', '=', 0); //active

        if ($room_type_id) {
            $query->where('room_type_id', $room_type_id);
        }

        if ($input_people) {
            $query->where('max_people', '>=', intval($input_people));
        }

        $availableRooms = $query->select('id')->get()->toArray();

        if (empty($availableRooms)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No rooms available for the given type or capacity.',
            ], 404);
        }

        $arr_room_manages = [];
        foreach ($availableRooms as $room) {
            $records_manage = ManageStatusRoom::where('room_id', $room['id'])
                ->where('status', 1) // Phòng phải ở trạng thái hoạt động
                ->where(function ($query) use ($fromTimestamp, $toTimestamp) {
                    $query->where(function ($q) use ($fromTimestamp, $toTimestamp) {
                        // Trường hợp 1: Khoảng ngày cụ thể (from <= $toTimestamp và to >= $fromTimestamp)
                        $q->where('from', '<=', $fromTimestamp)
                            ->where('to', '>=', $toTimestamp)
                            ->where('to', '!=', 0); // Loại bỏ khoảng vô hạn
                    })
                    ->orWhere(function ($q) use ($fromTimestamp) {
                        // Trường hợp 2: Khoảng vô hạn (to = 0)
                        $q->where('to', 0)
                            ->where('from', '<=', $fromTimestamp); // Điều kiện sửa đổi: chỉ lấy khi $fromTimestamp >= from
                    });
                })
                ->get()
                ->toArray();
                // ->toSql();
            if (!empty($records_manage)) {
                $arr_room_manages = array_merge($arr_room_manages, $records_manage);
            }
        }

        if (empty($arr_room_manages)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No rooms available for the selected dates.',
            ], 404);
        }

        $roomIds = array_column($arr_room_manages, 'room_id');
        
        $results_rooms = Room::whereIn('id', $roomIds)
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

        $arr_rooms = Room::where('room_type_id', $room_type_id)
            ->where('max_people', '>=', $input_people)
            ->select('id')
            ->get()
            ->toArray();

        if (empty($arr_rooms)) {
            return response()->json(['error' => 'Không có phòng nào thỏa mãn điều kiện.'], 404);
        }

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

        $results = [];
        foreach ($arr_room_manages as $room) {
            if ($room['from'] <= $from && $room['to'] == 0) {
                $results[] = $room['room_id'];
                continue;
            }

            if ($room['from'] <= $from && $to <= $room['to']) {
                $results[] = $room['room_id'];
            }
        }

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
