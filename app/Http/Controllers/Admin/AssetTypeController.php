<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AssetTypeRequest;
use App\Models\Admin\AssetType;
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
        $assets = AssetType::select('id')->orderBy('id','desc')->first();
        $assets->id = $assets->id+1;
        return view(self::VIEW_PATH . __FUNCTION__, compact('assets','title'));
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

    public function destroy($id)
    {
        $assetType = AssetType::find($id);

        if (!$assetType) {
            return redirect()->route(self::VIEW_PATH . __FUNCTION__)->with('error', 'Loại tài sản không tồn tại');
        }

        if ($assetType->roomAssets()->exists()) {
            return redirect()->route(self::VIEW_PATH . __FUNCTION__)->with('error', 'Không thể xóa loại tài sản vì có bản ghi liên kết trong tiện nghi phòng');
        }

        // Xóa file ảnh nếu tồn tại
        if ($assetType->image) {
            Storage::disk('public')->delete($assetType->image);
        }

        $assetType->delete();

        return redirect()->route('asset-types.index')->with('success', 'Xóa loại tài sản thành công');
    }
}
