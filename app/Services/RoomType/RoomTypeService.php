<?php

namespace App\Services\RoomType;

use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class RoomTypeService
{
    public function getAllRoomTypes(int $perPage = 10, int $page = 1)
    {
        try {
            $roomTypes = RoomType::with('roomTypeImages')
                ->select('id', 'type', 'title', 'price_per_night', 'create_at')
                ->paginate($perPage, ['*'], 'page', $page);

            return [
                'total' => $roomTypes->total(),
                'data' => $roomTypes->items()
            ];
        } catch (Exception $e) {
            Log::error('Error fetching Room Types: ' . $e->getMessage());
            return ['total' => 0, 'data' => []];
        }
    }

    public function createRoomType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $roomType = new RoomType();
            $roomType->type = $request->input('type');
            $roomType->title = $request->input('title');
            $roomType->price_per_night = $request->input('price_per_night');

            $roomType->save();

            return response()->json([
                'message' => 'Thêm loại phòng thành công!',
                'data' => $roomType
            ], 201);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json([
                'error' => 'Có lỗi xảy ra khi thêm loại phòng: ' . $e->getMessage()
            ], 500);
        }
    }
}
