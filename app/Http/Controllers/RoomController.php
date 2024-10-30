<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
    public function search(Request $request)
    {
        $type = $request->input('type');
        $group_adults = (int) $request->input('group_adults', 0);
        $group_children = (int) $request->input('group_children', 0);
        $ages = $request->query('age', []);
        $sl_rooms = (int) $request->input('sl_rooms', 1);

        if (!is_array($ages)) {
            $ages = [$ages];
        }

        foreach ($ages as $age) {
            if ((int)$age > 3) {
                $group_adults += 1;
                $group_children -= 1;
            }
        }

        $ages = array_map('intval', $ages);

        $people_per_room = intdiv($group_adults, $sl_rooms);
        $remaining_people = $group_adults % $sl_rooms;

        $people_distribution = array_fill(0, $sl_rooms, $people_per_room);

        for ($i = 0; $i < $remaining_people; $i++) {
            $people_distribution[$i]++;
        }

        $roomType = RoomType::where('type', 'like', '%' . $type . '%')->first();
        $roomCount = Room::where('room_type_id',$roomType->id)->count();

        if($sl_rooms > $roomCount){
            return response()->json([
                'status' => 'failed',
                'message' => 'Loại phòng này hiện không đáp ứng được yêu cầu quý khách.'
            ], 400);
        }

        $rooms = $roomType ? $roomType->rooms()->take($sl_rooms)->get() : [];

        // Trả về dữ liệu JSON
        return response()->json([
            'status' => 'success',
            'data' => [
                'type' => $type,
                'people' => $group_adults,
                'group_adults' => $group_adults,
                'group_children' => $group_children,
                'ages' => $ages,
                'people_distribution' => $people_distribution,
                'rooms' => $rooms,
            ]
        ], 200);
    }
}

