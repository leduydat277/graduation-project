<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AssetTypeRequest;
use App\Models\Admin\AssetType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AssetTypeController  extends Controller
{
    const VIEW_PATH = 'admin.assettypes.';

    public function index(Request $request)
    {
        //Tiêu đề trang
        $title = 'Danh sách loại tài sản';

        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('search');
    
        // Lấy cột sắp xếp và thứ tự sắp xếp từ request (mặc định sắp xếp theo 'id' tăng dần)
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
    
        // Kiểm tra tính hợp lệ của cột sắp xếp để tránh lỗi
        if (!in_array($sortBy, ['id', 'name', 'description'])) {
            $sortBy = 'id';
        }
    
        // Truy vấn danh sách asset types với tìm kiếm và sắp xếp
        $assetTypes = AssetType::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10); // Sử dụng phân trang
    
        // Truyền các tham số sang view
        return view(self::VIEW_PATH . 'index', compact('assetTypes', 'search', 'sortBy', 'sortOrder', 'title'));
    }


    public function create()
    {
        //Tiêu đề trang
        $title = 'Thêm loại tài sản';

        // Truyền các tham số sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('title'));
    }
    

    public function store(AssetTypeRequest $request)
    {
        $data = $request->except('_token');
        
    
        // Tạo mới một bản ghi trong bảng asset types
        AssetType::create($data);
    
        // Chuyển hướng về trang danh sách asset types với thông báo
        return redirect()->route('asset-types.index')->with('success', 'Thêm loại tài sản thành công');
    }

    public function edit($id)
    {
        //Tiêu đề trang
        $title = 'Sửa loại tài sản';

        // Lấy thông tin loại tài sản theo $id
        $assetType = AssetType::findOrFail($id);
    
        // Truyền các tham số sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('assetType', 'title'));
    }

    public function update(AssetTypeRequest $request, $id)
    {
        $assetType = AssetType::findOrFail($id);

        $data = $request->except('_token', '_method');

        $assetType->update($data);

        // Chuyển hướng về trang danh sách asset types với thông báo
        return redirect()->route('asset-types.index')->with('success', 'Cập nhật loại tài sản thành công');
    }

    public function destroy($id)
{
    // Tìm asset type theo id
    $assetType = AssetType::find($id);

    if (!$assetType) {
        return redirect()->route('asset-types.index')->with('error', 'Loại tài sản không tồn tại');
    }

    // Kiểm tra xem asset type có bất kỳ bản ghi nào trong room-assets không
    if ($assetType->roomAssets()->exists()) {
        return redirect()->route('asset-types.index')->with('error', 'Không thể xóa loại tài sản vì có bản ghi liên kết trong tiện nghi phòng');
    }

    // Xóa asset type
    $assetType->delete();

    // Chuyển hướng về trang danh sách asset types với thông báo thành công
    return redirect()->route('asset-types.index')->with('success', 'Xóa loại tài sản thành công');
}

}
