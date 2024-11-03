<?php

namespace App\Http\Controllers\FE;

use App\Models\Admin\Room as AdminRoom;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FeRoomController extends Controller
{
    public function getRooms()
    {
        // Lấy tất cả các phòng cùng với loại phòng tương ứng
        $rooms = AdminRoom::with('roomType')->get();

        // Chuyển đổi dữ liệu thành định dạng yêu cầu
        $formattedRooms = $rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'room_type_id' => [
                    'id' => $room->roomType->id,
                    'type' => $room->roomType->type,
                ],
                'image_room' => json_decode($room->image_room),
                'max_people' => $room->max_people,
                'title' => $room->title,
                'price' => $room->price,
                'room_area' => $room->room_area,
                'description' => $room->description,
                'status' => $room->status,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedRooms
        ], 200);
    }
}
