<?php
namespace App\Http\Controllers\Api;

use App\Models\admin\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DateTime;

class RoomController
{
    
    public function search(Request $request)
    {   
        $validated = $request->validate([
            'room_type_id' => 'nullable|integer',
            'room_id' => 'nullable|integer',
            'input_people' => 'nullable|integer|min:1',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
        ]);
    
        $room_type_id = $validated['room_type_id'] ?? null;
        $room_id = $validated['room_id'] ?? null;
        $input_people = $validated['input_people'] ?? 1;
        $from = new DateTime($validated['from']);
        $to = new DateTime($validated['to']);
    
        
        $from = $from->setTime(14, 0, 0)->getTimestamp();  
        $to = $to->setTime(12, 0, 0)->getTimestamp();    
    
       
        if ($room_id != null) {
            $current_time_room = ManageStatusRoom::select('room_id', 'from', 'to')
                ->where('room_id', $room_id)
                ->where('status', 1)
                ->get()
                ->toArray();
    
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
    
       
        $rooms_query = Room::query();
    
     
        if ($room_type_id) {
            $rooms_query->where('room_type_id', $room_type_id);
        }
    
      
        $rooms_query->where('max_people', '>=', $input_people);
    
     
        $rooms_query->where('status', 0);  
    
        $arr_rooms = $rooms_query->select('id')->get()->toArray();
    
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
    

    public function index()
    {
        $rooms = Room::whereIn('status', [0, 1, 2])->get()->map(function ($room) {
            $statusMap = [
                0 => 'sẵn sàng',
                1 => 'đã cọc',
                2 => 'đang sử dụng',
            ];

            return [
                'id' => $room->id,
                'roomId_number' => $room->roomId_number,
                'room_type_id' => $room->room_type_id,
                'image_room' => json_decode($room->image_room, true),
                'max_people' => $room->max_people,
                'title' => $room->title,
                'price' => $room->price,
                'room_area' => $room->room_area,
                'description' => $room->description,
                'status' => $statusMap[$room->status] ?? 'không xác định',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $rooms,
        ]);
    }

    public function detail($id)
    {
        $room = Room::find($id);
        return Inertia::render('DetailRoom', [
            'room' => $room
        ]);
    }

    public function getRoomBooking()
    {
        $rooms = Room::with('roomType')
            ->get()
            ->map(function ($room) {
                return [
                    'id' => $room->id,
                    'title' => $room->title,
                    'room_type' => $room->roomType->type ?? 'Không xác định',
                    'price' => $room->price,
                    'max_people' => $room->max_people,
                    'room_area' => $room->room_area,
                    'description' => $room->description,
                    'status' => $room->status,
                    'image_room' => json_decode($room->image_room),
                ];
            });
    
        return response()->json([
            'success' => true,
            'data' => $rooms,
        ]);
    }

    public function roomAll(){
        $data = Room::with('roomType')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Rooms retrieved successfully.',
            'code' => 200,
            'data' => $data
        ], 200);
    }
}
