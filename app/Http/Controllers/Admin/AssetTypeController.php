<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AssetTypeRequest;
use App\Models\Admin\AssetType;
use App\Models\Admin\RoomAsset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class AssetTypeController extends Controller
{
    const VIEW_PATH = 'admin.assettypes.';

    public function index(Request $request)
    {
        $title = 'Danh sách loại tài sản';
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');

        if (!in_array($sortBy, ['id', 'name', 'description', 'status', 'image'])) {
            $sortBy = 'id';
        }

        $assetTypes = AssetType::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        return view(self::VIEW_PATH . __FUNCTION__, compact('assetTypes', 'search', 'sortBy', 'sortOrder', 'title'));
    }

    public function create()
    {
        $title = 'Thêm loại tài sản';
        $assets = AssetType::select('id')->orderBy('id', 'desc')->first();

        if (!$assets) {
            $assets = (object) ['id' => 1];
        } else {
            $assets->id = $assets->id + 1;
        }

        return view(self::VIEW_PATH . __FUNCTION__, compact('assets', 'title'));
    }

    public function store(AssetTypeRequest $request)
    {
        $data = $request->except('_token');

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets_types', 'public');
        }

        AssetType::create($data);

        return redirect()->route('asset-types.index')->with('success', 'Thêm loại tài sản thành công');
    }

    public function edit($id)
    {
        $title = 'Sửa loại tài sản';
        $assetType = AssetType::findOrFail($id);
        return view(self::VIEW_PATH . __FUNCTION__, compact('assetType', 'title'));
    }

    public function update(AssetTypeRequest $request, $id)
    {
        $assetType = AssetType::findOrFail($id);
        $data = $request->except('_token', '_method');

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            if ($assetType->image) {
                Storage::disk('public')->delete($assetType->image);
            }
            $data['image'] = $request->file('image')->store('assets_types', 'public');
        }

        $assetType->update($data);

        return redirect()->route('asset-types.index')->with('success', 'Cập nhật loại tài sản thành công');
    }

    public function lock($id)
    {
        $assetType = AssetType::select('id', 'status')->find($id);

        if (!$assetType) {
            return redirect()->route('asset-types.index')->with('error', 'Loại tài sản không tồn tại');
        }

        $assetType->status = 1;
        $assetType->save();

        $roomAssets = RoomAsset::where('assets_type_id', $id)->get();

        foreach ($roomAssets as $item) {
            $item->delete();
        }

        return redirect()->route('asset-types.index')->with('success', 'Tạm ngưng sử dụng tiện nghi thành công');
    }

    public function unlock($id)
    {
        $assetType = AssetType::select('id', 'status')->find($id);

        if (!$assetType) {
            return redirect()->route('asset-types.index')->with('error', 'Loại tài sản không tồn tại');
        }

        $assetType->status = 0;
        $assetType->save();

        return redirect()->route('asset-types.index')->with('success', 'Mở khóa tiện nghi thành công');
    }
}
