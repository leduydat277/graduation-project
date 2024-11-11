<?php

namespace App\Http\Controllers\Web;

use App\Models\Review;
use App\Models\Room;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;

class DetailController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Detail/Index');
    }

    public function detail($id)
    {
        $room = Room::with('roomType')->select('id', 'room_type_id', 'image_room', 'max_people', 'title', 'price', 'room_area', 'description')->where('id', $id)->first();
        if (!$room) {
            return response()->json([
                "type" => "error",
                "message" => "Phòng này đã không còn tồn tại!"
            ], 400);
        }
        $review = Review::with('user')->select('user_id', 'room_id', 'rating', 'comment')->where('room_id', $id)->get();
        return response()->json([
            "type" => "success",
            "room" => $room,
            "review" => $review
        ]);
    }
}
