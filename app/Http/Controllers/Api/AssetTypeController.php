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
        $assetsTypes = AssetType::where('status', 0) 
            ->take(6) 
            ->get(); 

        return response()->json($assetsTypes, 200);
    }
}
