<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin\AssetType;
use App\Models\Admin\Review;
use App\Models\Admin\RoomAsset;
use App\Models\Room;


class RoomDetailController
{
    public function index($id){
        $room = Room::find($id);

        $images = json_decode($room->image_room);

        $assets_room = RoomAsset::where('room_id', $id)->get();
        $assets_type_ids = $assets_room->pluck('assets_type_id');
        $assets_type = AssetType::whereIn('id', $assets_type_ids)->get();

        $comments = Review::where('room_id', $id)
        ->with('user')
        ->get();
        return view('client.room-details', compact('room', 'images', 'assets_type', 'comments'));
    }
}
