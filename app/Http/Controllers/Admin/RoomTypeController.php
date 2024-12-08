<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoomTypeRequest;
use App\Http\Requests\Admin\RoomTypeUpddateRequest;
use App\Models\Admin\RoomType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    const VIEW_PATH = 'admin.roomtypes.';


    public function index(Request $request)
    {
        $title = 'Danh sách loại phòng';

        // Lấy dữ liệu từ request
        $search = $request->input('search', ''); // Dữ liệu từ form tìm kiếm
        $sort = $request->input('sort', 'roomType_number_asc'); // Dữ liệu từ form filter (sắp xếp)

        // Phân tách `sort` thành cột và thứ tự
        [$sortBy, $sortOrder] = explode('_', $sort);

        // Xác định các cột hợp lệ
        $validColumns = ['roomType_number', 'type', 'rooms_count'];
        $validOrders = ['asc', 'desc'];

        // Kiểm tra tính hợp lệ của sortBy và sortOrder
        if (!in_array($sortBy, $validColumns) || !in_array($sortOrder, $validOrders)) {
            $sortBy = 'roomType_number';
            $sortOrder = 'asc';
        }

        // Truy vấn dữ liệu
        $roomTypes = RoomType::query()
            ->withCount('rooms') // Đếm số lượng phòng liên kết
            ->when($search, function ($query, $search) {
                return $query->where('type', 'LIKE', '%' . $search . '%')
                    ->orWhere('roomType_number', 'LIKE', '%' . $search . '%'); // Tìm kiếm theo mã hoặc tên loại phòng
            })
            ->orderBy($sortBy, $sortOrder) // Sắp xếp theo filter
            ->paginate(10)
            ->appends(['search' => $search, 'sort' => $sort]); // Giữ lại query string khi phân trang

        return view(self::VIEW_PATH . __FUNCTION__, compact('roomTypes', 'search', 'sort', 'title'));
    }

    public function showroom($id)
    {
        $roomType = RoomType::with('rooms')->findOrFail($id); // Lấy loại phòng cùng danh sách phòng
        $rooms = $roomType->rooms; // Lấy danh sách phòng
        $title = "Danh sách phòng thuộc loại: " . $roomType->type;

        return view(self::VIEW_PATH . __FUNCTION__, compact('roomType', 'rooms', 'title'));
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

        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/room_types', 'public'); // Lưu vào thư mục public/uploads/room_types
        }

        RoomType::create([
            'roomType_number' => $request->roomType_number,
            'type' => $data['type'],
            'description' => $data['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('room-types.index')->with('success', 'Thêm mới thành công');
    }


    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        $title = 'Chỉnh sửa loại phòng';

        return view(self::VIEW_PATH . __FUNCTION__, compact('roomType', 'title'));
    }

    public function update(RoomTypeUpddateRequest $request, $id)
    {
        $roomType = RoomType::findOrFail($id);
        $data = $request->except('_token', '_method');

        $check = RoomType::where('type', $data['type'])->where('id', '!=', $id)->first();
        if ($check) {
            return redirect()->route('room-types.index')->with('error', 'Tên loại phòng đã tồn tại.');
        }

        // Xử lý upload ảnh
        $imagePath = $roomType->image; // Giữ ảnh cũ nếu không upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($roomType->image) {
                Storage::disk('public')->delete($roomType->image);
            }
            $imagePath = $request->file('image')->store('uploads/room_types', 'public');
        }

        $roomType->update([
            'roomType_number' => $request->roomType_number,
            'type' => $data['type'],
            'description' => $data['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('room-types.index')->with('success', 'Cập nhật thành công');
    }



    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);

        if ($roomType->rooms()->exists()) {
            return redirect()->route('room-types.index')->with('error', 'Không thể xóa loại phòng vì có phòng liên quan.');
        }

        // Xóa ảnh nếu có
        if ($roomType->image) {
            Storage::disk('public')->delete($roomType->image);
        }

        $roomType->delete();

        return redirect()->route('room-types.index')->with('success', 'Xóa loại phòng thành công');
    }
}
