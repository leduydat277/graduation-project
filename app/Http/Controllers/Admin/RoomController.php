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
        $status = $request->input('status');
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
            ->when($status, function ($query, $status) {
                return $query->where('title', 'LIKE', '%' . $status . '%')
                    ->orWhereHas('roomType', function ($query) use ($status) {
                        $query->where('status', '=', $status);
                    });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10); // Phân trang với 10 bản ghi mỗi trang

        return view(self::VIEW_PATH . __FUNCTION__, compact('rooms', 'search', 'sortBy', 'sortOrder'))
            ->with('title', 'Danh sách Phòng');
    }

    public function getRoomBookings(Request $request) {
        $query = Room::select("rooms.id", "rooms.title", "rooms.price", "rooms.max_people", "bookings.check_in_date", "bookings.check_out_date")
                     ->leftJoin("bookings", "bookings.room_id", "=", "rooms.id")
                     ->groupBy("rooms.id", "rooms.title", "rooms.price", "rooms.max_people", "bookings.check_in_date", "bookings.check_out_date");


        if($request->has("room_type_id")){
            $query->where("rooms.room_type_id", $request->input("room_type_id"));
        }
        if($request->has("max_people")){
            $query->where("rooms.max_people", "<=" ,$request->input("max_people"));
        }
    
        $checkInDate = $request->input("check_in_date");
        $checkOutDate = $request->input("check_out_date");
    
        if ($checkInDate && $checkOutDate) {
            $query->whereNotExists(function($subQuery) use ($checkInDate, $checkOutDate) {
                $subQuery->select("bookings.room_id")
                         ->from("bookings")
                         ->whereColumn("bookings.room_id", "=", "rooms.id")
                         ->where(function($dateQuery) use ($checkInDate, $checkOutDate) {
                             $dateQuery->whereBetween("bookings.check_in_date", [$checkInDate, $checkOutDate])
                                       ->orWhereBetween("bookings.check_out_date", [$checkInDate, $checkOutDate])
                                       ->orWhere(function($overlapQuery) use ($checkInDate, $checkOutDate) {
                                           $overlapQuery->where("bookings.check_in_date", "<=", $checkInDate)
                                                        ->where("bookings.check_out_date", ">=", $checkOutDate);
                                       });
                         });
            });
        }
        $data = $query->get();
        return response()->json($data);
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

    /**
     * Summary of destroy
     * Fix khi push 1 ảnh thì không được xóa hết
     * 
     * @param \App\Models\Admin\Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
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
