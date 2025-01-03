<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoomAssetRequest;
use App\Models\Admin\AssetType;
use App\Models\Admin\Room;
use App\Models\Admin\RoomAsset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoomAssetController extends Controller
{
    const VIEW_PATH = 'admin.roomassets.';

    public function index(Request $request)
    {
        //Tiêu đề trang
        $title = 'Danh sách tiện nghi phòng';

        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('search');

        // Lấy cột sắp xếp và thứ tự sắp xếp từ request (mặc định sắp xếp theo 'id' tăng dần)
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');

        // Kiểm tra tính hợp lệ của cột sắp xếp để tránh lỗi
        if (!in_array($sortBy, ['id', 'room_id', 'assets_type_id', 'status'])) {
            $sortBy = 'id';
        }

        // Truy vấn danh sách room assets với tìm kiếm và sắp xếp
        $roomassets = RoomAsset::with('room', 'assetType')
            ->when($search, function ($query, $search) {
                return $query->where('room_id', 'LIKE', "%{$search}%")
                    ->orWhere('assets_type_id', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10); // Sử dụng phân trang

        // Truyền các tham số sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('roomassets', 'search', 'sortBy', 'sortOrder', 'title'));
    }

    public function create()
    {
        //Tiêu đề trang
        $title = 'Thêm tiện nghi phòng';

        //danh sách phòng
        $rooms = Room::all();

        //danh sach loại tiện nghi
        $assetTypes = AssetType::all();


        // Truyền các tham số sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('title', 'rooms', 'assetTypes'));
    }

    public function store(RoomAssetRequest $request)
    {
        $data = $request->except('_token');

        // Kiểm tra xem phòng đã có loại tiện nghi này chưa
        $existingRoomAsset = RoomAsset::where('room_id', $data['room_id'])
            ->where('assets_type_id', $data['assets_type_id'])
            ->first();

        if ($existingRoomAsset) {
            // Nếu đã tồn tại, trả về với thông báo lỗi
            return redirect()->back()->with('error', 'Phòng này đã có loại tiện nghi này rồi.');
        }

        // Tạo mới room asset nếu không có xung đột
        RoomAsset::create($data);

        // Chuyển hướng đến trang danh sách room assets với thông báo thành công
        return redirect()->route('room-assets.index')->with('success', 'Thêm mới thành công');
    }


    public function edit($id)
    {
        //Tiêu đề trang
        $title = 'Sửa tiện nghi phòng';

        // Lấy thông tin room asset theo $id
        $roomasset = RoomAsset::findOrFail($id);

        //danh sách phòng
        $rooms = Room::all();

        //danh sach loại tiện nghi
        $assetTypes = AssetType::all();

        // Truyền các tham số sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('title', 'roomasset', 'rooms', 'assetTypes'));
    }

    public function update(RoomAssetRequest $request, $id)
    {
        $roomasset = RoomAsset::findOrFail($id);
        $data = $request->except('_token', '_method');

        // Kiểm tra xem phòng đã có loại tiện nghi này chưa (ngoại trừ bản ghi hiện tại)
        $existingRoomAsset = RoomAsset::where('room_id', $data['room_id'])
            ->where('assets_type_id', $data['assets_type_id'])
            ->where('id', '!=', $id) // Loại trừ bản ghi hiện tại để tránh xung đột
            ->first();

        if ($existingRoomAsset) {
            // Nếu đã tồn tại, trả về với thông báo lỗi
            return redirect()->back()->with('error', 'Phòng này đã có loại tiện nghi này rồi.');
        }

        // Cập nhật room asset nếu không có xung đột
        $roomasset->update($data);

        // Chuyển hướng đến trang danh sách room assets với thông báo thành công
        return redirect()->route('room-assets.index')->with('success', 'Cập nhật thành công');
    }


    public function destroy($id)
    {
        // Tìm room asset theo ID
        $roomAsset = RoomAsset::find($id);
        // Xóa room asset
        $roomAsset->delete();

        // Chuyển hướng đến trang danh sách room assets với thông báo thành công
        return redirect()->route('room-assets.index')->with('success', 'Xóa thành công');
    }
}
