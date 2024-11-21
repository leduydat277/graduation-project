<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Room;
use Illuminate\Http\Request;

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
     
        $rooms = Room::all();

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
