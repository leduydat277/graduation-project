<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\RoomType;
use Illuminate\Http\Request;

class RoomTypeController
{
    public function index(){
        $roomTypes = RoomType::select('id','type', 'description', 'image')->get();
        return response()->json([
            'type' => 'success',
            'data' => $roomTypes,
        ]);
    }
}
