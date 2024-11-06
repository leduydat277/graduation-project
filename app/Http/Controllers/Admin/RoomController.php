<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoomRequest;
use App\Http\Requests\Admin\UpdateRoomRequest;
use App\Models\Admin\Room;
use App\Models\Admin\RoomType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    const VIEW_PATH = "admin.rooms.";


    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = $request->input('search');

        // Lấy các tham số sắp xếp
        $sortBy = $request->input('sort_by', 'id'); // Mặc định sắp xếp theo 'id'
        $sortOrder = $request->input('sort_order', 'asc'); // Mặc định sắp xếp tăng dần

        // Lấy danh sách phòng với tìm kiếm và sắp xếp
        $rooms = Room::with('roomType')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('roomType', function ($query) use ($search) {
                        $query->where('type', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10); // Phân trang với 10 bản ghi mỗi trang

        return view(self::VIEW_PATH . __FUNCTION__, compact('rooms', 'search', 'sortBy', 'sortOrder'))
            ->with('title', 'Danh sách Phòng');
    }

    public function create()
    {

        $title = 'Thêm phòng';

        $roomTypes = RoomType::all();

        return view(self::VIEW_PATH . __FUNCTION__, compact('title', 'roomTypes'));
    }


    public function store(RoomRequest $request)
    {
        $imagePaths = [];

        // Lưu từng ảnh và lưu đường dẫn vào mảng
        if ($request->hasFile('image_room')) {
            foreach ($request->file('image_room') as $image) {

                $path = $image->store('upload/rooms', 'public'); // Lưu ảnh vào thư mục 'rooms' trong 'public'
                $imagePaths[] = $path; // Thêm đường dẫn ảnh vào mảng
            }
        }
        // dd(request()->all());
        // Tạo phòng với dữ liệu đầu vào và lưu đường dẫn ảnh dưới dạng JSON
        $room = Room::create([
            'title' => $request->input('title'),
            'room_type_id' => $request->input('room_type'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'room_area' => $request->input('room_area'),
            'max_people' => $request->input('max_people'),
            'image_room' => json_encode($imagePaths), // Lưu ảnh dưới dạng JSON
            'status' => $request->input('status')
        ]);

        return redirect()->route('rooms.index')->with('success', 'Phòng đã được thêm thành công.');
    }


    public function show($id)
    {

        $title = 'Chi tiết phòng';
        $room = Room::findOrFail($id);

        return view(self::VIEW_PATH . __FUNCTION__, compact('room', 'title'));
    }

    public function edit($id)
    {

        $title = 'Chỉnh sửa phòng';
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();

        return view(self::VIEW_PATH . __FUNCTION__, compact('room', 'title', 'roomTypes'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $imagePaths = json_decode($room->image_room, true) ?? []; // Lấy ảnh hiện tại nếu có, nếu không thì là mảng rỗng

        // Nếu có ảnh mới được tải lên, lưu ảnh mới và cập nhật mảng $imagePaths
        if ($request->hasFile('image_room')) {
            // Xóa ảnh cũ khỏi thư mục (nếu cần thiết)
            foreach ($imagePaths as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            // Lưu ảnh mới
            $imagePaths = [];
            foreach ($request->file('image_room') as $image) {
                $path = $image->store('upload/rooms', 'public'); // Không cần thêm time() vì Laravel sẽ tự động thêm timestamp vào tên file
                $imagePaths[] = $path;
            }
        }

        // Cập nhật dữ liệu phòng với các trường đầu vào mới và ảnh dưới dạng JSON
        $room->update([
            'title' => $request->input('title'),
            'room_type_id' => $request->input('room_type'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'room_area' => $request->input('room_area'),
            'max_people' => $request->input('max_people'),
            'image_room' => json_encode($imagePaths), // Lưu ảnh dưới dạng JSON
            'status' => $request->input('status', $room->status), // Giữ nguyên trạng thái nếu không thay đổi
        ]);

        return redirect()->route('rooms.index')->with('success', 'Phòng đã được cập nhật thành công.');
    }


    public function destroy(Room $room)
    {
        // Xóa tất cả các ảnh liên quan đến phòng nếu có
        if (!empty($room->image_room)) {
            $imagePaths = json_decode($room->image_room, true);

            // Lặp qua từng đường dẫn ảnh và xóa chúng khỏi thư mục storage
            foreach ($imagePaths as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Xóa phòng khỏi cơ sở dữ liệu
        $room->delete();

        // Trả về với thông báo thành công
        return redirect()->route('rooms.index')->with('success', 'Phòng đã được xóa thành công.');
    }
}
