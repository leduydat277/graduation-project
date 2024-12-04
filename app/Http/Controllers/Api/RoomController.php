<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController
{
    // public function index()
    // {
    //     $rooms = Room::with('roomType')
    //         ->get()
    //         ->map(function ($room) {
    //             return [
    //                 'id' => $room->id,
    //                 'title' => $room->title,
    //                 'room_type' => $room->roomType->type ?? 'Không xác định',
    //                 'price' => $room->price,
    //                 'max_people' => $room->max_people,
    //                 'room_area' => $room->room_area,
    //                 'description' => $room->description,
    //                 'status' => $room->status,
    //                 'image_room' => json_decode($room->image_room),
    //             ];
    //         });

    //     return response()->json([
    //         'success' => true,
    //         'data' => $rooms,
    //     ]);
    // }
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
                'image_room' => json_decode($room->image_room, true), // Chuyển JSON thành mảng (nếu cần)
                'max_people' => $room->max_people,
                'title' => $room->title,
                'price' => $room->price,
                'room_area' => $room->room_area,
                'description' => $room->description,
                'status' => $statusMap[$room->status] ?? 'không xác định', // Trạng thái chuyển sang chuỗi
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
}
