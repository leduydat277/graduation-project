<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoomTypeRequest;
use App\Models\Admin\RoomType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoomTypeController extends Controller
{
    const VIEW_PATH = 'admin.roomtypes.';


    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = $request->input('search');

        // Lấy các tham số sắp xếp
        $sortBy = $request->input('sort_by', 'id'); // Mặc định sắp xếp theo 'id'
        $sortOrder = $request->input('sort_order', 'asc'); // Mặc định sắp xếp tăng dần
        $title = "Danh sách loại phòng";

        // Lấy danh sách các loại phòng với tìm kiếm và sắp xếp
        $roomTypes = RoomType::query()
            ->when($search, function ($query, $search) {
                return $query->where('type', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10); // Phân trang với 10 bản ghi mỗi trang

        return view(self::VIEW_PATH . __FUNCTION__, compact('roomTypes', 'search', 'sortBy', 'sortOrder', 'title'));
    }

    public function create()
    {
        $title = 'Thêm mới loại phòng';
        return view(self::VIEW_PATH . __FUNCTION__, compact('title'));
    }

    public function store(RoomTypeRequest $request)
    {
        $data = $request->except('_token');

        $check = RoomType::where('type', $data['type'])->first();

        if ($check) {
            return redirect()->route('room-types.index')->with('error', 'Tên loại phòng đã tồn tại.');
        }

        RoomType::create($data);

        return redirect()->route('room-types.index')->with('success', 'Thêm mới thành công');
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        $title = 'Chỉnh sửa loại phòng';

        return view(self::VIEW_PATH . __FUNCTION__, compact('roomType', 'title'));
    }

    public function update(RoomTypeRequest $request, $id)
    {
        $roomType = RoomType::findOrFail($id);


        $data = $request->except('_token', '_method');

        $check = RoomType::where('type', $data['type'])->where('id', '!=', $id)->first();

        if ($check) {
            return redirect()->route('room-types.index')->with('error', 'Tên loại phòng đã tồn tại.');
        }

        $roomType->update($data);

        return redirect()->route('room-types.index')->with('success', 'Cập nhập thành công');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);

        // Kiểm tra xem RoomType có các phòng liên quan không
        if ($roomType->rooms()->exists()) {
            return redirect()->route('room-types.index')->with('error', 'Không thể xóa loại phòng vì có phòng liên quan.');
        }

        $roomType->delete();

        return redirect()->route('room-types.index')->with('success', 'Xóa loại phòng thành công');
    }
}
