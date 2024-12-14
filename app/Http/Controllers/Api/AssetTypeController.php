<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\AssetType;
use Illuminate\Http\Request;

class AssetTypeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách các bản ghi có trạng thái = 0 và giới hạn 6 bản ghi
        $assetsTypes = AssetType::where('status', 0) // Lọc trạng thái = 0
            ->take(6) // Giới hạn kết quả trả về là 6 bản ghi
            ->get(); // Lấy danh sách các bản ghi

        // Trả về danh sách dưới dạng JSON
        return response()->json($assetsTypes, 200);
    }
}
