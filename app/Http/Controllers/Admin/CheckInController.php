<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Room;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CheckInController extends Controller
{

    public function CheckIn(Request $request)
    {
        $room = Room::find($request->booking_id);
        $manage_status_room = ManageStatusRoom::where('booking_id', $request->booking_id)->first();

        if (!$room || !$manage_status_room) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found. Please verify booking ID.'
            ], Response::HTTP_NOT_FOUND);
        }

        $room->update([
            'CCCD_booking' => $request->CCCD_booking,
            'status' => '4'
        ]);

        $manage_status_room->update([
            'status' => '2'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in successful',
        ], Response::HTTP_OK);
    }
}