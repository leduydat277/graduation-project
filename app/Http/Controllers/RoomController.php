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

    // public function search(Request $request)
    // {
    //     $type = $request->input('type');
    //     $group_adults = (int) $request->input('group_adults', 0); // Mặc định là 0 nếu không có
    //     $group_children = (int) $request->input('group_children', 0); // Mặc định là 0 nếu không có
    //     $ages = $request->query('age', []);
    //     $count_room = (int) $request->input('count_room', 1);

    //     if (!is_array($ages)) {
    //         $ages = [$ages];
    //     }

    //     $ages = array_map('intval', $ages);

    //     foreach ($ages as $age) {
    //         if ((int)$age > 3) {
    //             $group_adults += 1;  // Nếu lớn hơn 3 tuổi, thêm vào số người lớn
    //             $group_children -= 1; // Giảm số trẻ em đi 1
    //         }
    //     }

    //     $people_per_room = intdiv($group_adults, $count_room);
    //     $remaining_people = $group_adults % $count_room;

    //     $people_distribution = array_fill(0, $count_room, $people_per_room);

    //     // Phân bổ số người còn lại cho các phòng đầu tiên
    //     for ($i = 0; $i < $remaining_people; $i++) {
    //         $people_distribution[$i]++;
    //     }

    //     $query = RoomType::select(['type', 'defaul_people', 'title', 'price_per_night', 'description']);

    //     if ($request->has('type') && !empty($request->type)) {
    //         $query->where('type', 'like', '%' . $type . '%');
    //     }

    //     if (!empty($group_adults)) {
    //         $query->where('defaul_people', $group_adults);
    //     }

    //     // Đảm bảo không có số trẻ em âm
    //     $group_children = max(0, $group_children);

    //     $room = $query->get();

    //     return response()->json([
    //         'message' => 'success',
    //         // 'data' => [
    //         //     'room' => $room
    //         // ]
    //         'data' => [
    //             'type' => $type,
    //             'group_adults' => $group_adults,
    //             'group_children' => $group_children,
    //             'ages' => $ages,
    //             'people_distribution' => $people_distribution,
    //         ]
    //     ], 200);
    // }

    // public function search(Request $request)
    // {
    //     $type = $request->input('type');
    //     $group_adults = (int) $request->input('group_adults', 0); // Đảm bảo mặc định là 0
    //     $group_children = (int) $request->input('group_children', 0); // Đảm bảo mặc định là 0
    //     $ages = $request->query('age', []);
    //     $sl_rooms = (int) $request->input('sl_rooms', 1);
    //     if (!is_array($ages)) {
    //         $ages = [$ages];
    //     }
    //     foreach ($ages as $age) {
    //         if ((int)$age > 3) {
    //             $group_adults += 1;
    //             $group_children -= 1;
    //         }
    //     }

    //     // $query = RoomType::select(['type', 'defaul_people', 'title', 'price_per_night', 'description']);

    //     // if ($request->has('type') && !empty($request->type)) {
    //     //     $query->where('type', 'like', '%' . $type . '%');
    //     // }

    //     // $roomType = RoomType::select(['type', 'defaul_people', 'title', 'price_per_night', 'description'])->where('type', $type)->first();

    //     $ages = array_map('intval', $ages);

    //     $people_per_room = intdiv($group_adults, $sl_rooms);
    //     $remaining_people = $group_adults % $sl_rooms;

    //     $people_distribution = array_fill(0, $sl_rooms, $people_per_room);

    //     // Phân bổ số người còn lại cho các phòng đầu tiên
    //     for ($i = 0; $i < $remaining_people; $i++) {
    //         $people_distribution[$i]++;
    //         $roomType = RoomType::where('type', 'like', '%' . $type . '%')->first();
    //         $rooms = $roomType ? $roomType->rooms()->take($sl_rooms)->get() : [];
    //     }

    //     // Trả về dữ liệu JSON
    //     return response()->json([
    //         'message' => 'success',
    //         'data' => [
    //             'type' => $type,
    //             'people' => $group_adults,
    //             'group_adults' => $group_adults,
    //             'group_children' => $group_children,
    //             'ages' => $ages,
    //             'people_distribution' => $people_distribution,
    //             'các rooms' => $roomType,
    //         ]
    //     ], 200);
    // }

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



//
// public function search(Request $request)
// {
//     $type = $request->input('type');
//     $group_adults = (int) $request->input('group_adults', 0); // Đảm bảo mặc định là 0
//     $group_children = (int) $request->input('group_children', 0); // Đảm bảo mặc định là 0
//     $ages = $request->query('age', []);
//     $sl_rooms = (int) $request->input('sl_rooms', 1);
//     if (!is_array($ages)) {
//         $ages = [$ages];
//     }
//     foreach ($ages as $age) {
//         if ((int)$age > 3) {
//             $group_adults += 1;  // Nếu lớn hơn 3 tuổi, thêm vào số người lớn
//             $group_children -= 1; // Giảm số trẻ em đi 1
//         }
//     }
//     $roomType = RoomType::where('type', $type)->first();

//     $rooms = $roomType ? $roomType->rooms : [];
//     $ages = array_map('intval', $ages);

//     $people_per_room = intdiv($group_adults, $sl_rooms);
//     $remaining_people = $group_adults % $sl_rooms;

//     $people_distribution = array_fill(0, $sl_rooms, $people_per_room);

//     // Phân bổ số người còn lại cho các phòng đầu tiên
//     for ($i = 0; $i < $remaining_people; $i++) {
//         $people_distribution[$i]++;
//     }
//     // Trả về dữ liệu JSON
//     return response()->json([
//         'message' => 'success',
//         'data' => [
//             'type' => $type,
//             'people' => $group_adults,
//             'group_adults' => $group_adults,
//             'group_children' => $group_children,
//             'ages' => $ages,
//             'people_distribution' => $people_distribution,
//         ]
//     ], 200);
// }
