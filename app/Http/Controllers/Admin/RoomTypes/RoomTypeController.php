<?php

namespace App\Http\Controllers\Admin\RoomTypes;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomTypeService;

    public function __construct(RoomTypeService $roomTypeService)
    {
        $this->roomTypeService = $roomTypeService;
    }

    public function index()
    {
        return view('admin.roomtype.index');
    }

    public function list(Request $request)
    {
        $perPage = $request->input('length', 10);
        $page = $request->input('start', 0) / $perPage + 1;

        $roomTypes = $this->roomTypeService->getAllRoomTypes($perPage, $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => RoomType::count(),
            'recordsFiltered' => $roomTypes['total'],
            'data' => $roomTypes['data']
        ], 200);
    }
}
