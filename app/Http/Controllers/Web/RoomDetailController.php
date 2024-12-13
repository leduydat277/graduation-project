<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin\AssetType;
use App\Models\Admin\RoomAsset;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomDetailController
{
    public function index($id){
        $title = "Chi tiết phòng";
        $room = Room::find($id);

        $images = json_decode($room->image_room);

        $assets_room = RoomAsset::where('room_id', $id)->get();
        $assets_type_ids = $assets_room->pluck('assets_type_id');
        $assets_type = AssetType::whereIn('id', $assets_type_ids)->get();

        $comments = Review::where('room_id', $id)
        ->with('user')
        ->get();
        return view('client.room-details', compact('room', 'images', 'assets_type', 'comments', 'title'));
    }

    // public function addComment(Request $request){
    //     $title = "Chi tiết phòng";
    //     $validatedData = $request->validate([
    //         'comment' => 'required|string|max:500',
    //         'rating' => 'required|integer|min:1|max:5',
    //     ]);
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->back()->with('error', 'Bạn cần đăng nhập để bình luận.');
    //     }
    //     $data = [
    //         'user_id' => $user->id,
    //         'room_id' => $request->id,
    //         'comment' => $validatedData['comment'],
    //         'rating' => $validatedData['rating']
    //     ];
    //     Review::create($data);
    //     return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.', compact('title'));

    // }

}
