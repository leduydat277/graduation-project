<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin\AssetType;
use Illuminate\Http\Request;

class SeviceController
{

    const VIEW_PATH = 'client.';
    public function services()
    {
        $title = 'Tiện Nghi';
        return view(self::VIEW_PATH . __FUNCTION__, compact('title'));
    }

    public function show($id)
    {
        $title = 'Chi tiết tiện nghi';
        $assetTypes = AssetType::take(6)->get();
        $assetType = AssetType::findOrFail($id);

        return view(self::VIEW_PATH . 'service-detail', compact('title', 'assetType', 'assetTypes'));
    }
}
