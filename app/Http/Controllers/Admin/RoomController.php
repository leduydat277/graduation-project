<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoomRequest;
use App\Http\Requests\Admin\UpdateRoomRequest;
use App\Models\Admin\ManageStatusRoom;
use App\Models\Admin\Review;
use App\Models\Admin\Room;
use App\Models\Admin\RoomAsset;
use App\Models\Admin\RoomType;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    const VIEW_PATH = "admin.rooms.";


    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = $request->input('search');

        // Lấy giá trị sort từ request
        $sortOption = $request->input('sort', '');
        $sortOptionsMap = [
            'title_asc' => ['title', 'asc'],
            'title_desc' => ['title', 'desc'],
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'room_area_asc' => ['room_area', 'asc'],
            'room_area_desc' => ['room_area', 'desc'],
            'capacity_asc' => ['max_people', 'asc'],
            'capacity_desc' => ['max_people', 'desc'],
            'status_asc' => ['status', 'asc'],
            'status_desc' => ['status', 'desc'],
        ];

        // Lấy cột và thứ tự sắp xếp từ map
        $sortBy = $sortOptionsMap[$sortOption][0] ?? 'id'; // Mặc định sắp xếp theo 'id'
        $sortOrder = $sortOptionsMap[$sortOption][1] ?? 'desc'; // Mặc định sắp xếp giảm dần

        // Lấy danh sách phòng
        $rooms = Room::with('roomType')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('roomType', function ($query) use ($search) {
                        $query->where('type', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        return view(self::VIEW_PATH . __FUNCTION__, compact('rooms', 'search', 'sortOption'))
            ->with('title', 'Danh sách Phòng');
    }


    public function create()
    {
        $title = 'Thêm phòng';

        $roomId = Room::select('id')->orderBy('id', 'DESC')->first();
        $roomId = $roomId ? $roomId->id + 1 : 1;

        $roomTypes = RoomType::all();

        return view(self::VIEW_PATH . __FUNCTION__, compact('title', 'roomTypes', 'roomId'));
    }


    public function store(RoomRequest $request)
    {
        $imagePaths = [];

        if ($request->hasFile('image_room')) {
            foreach ($request->file('image_room') as $image) {
                $path = $image->store('upload/rooms', 'public');
                $imagePaths[] = $path;
            }
        }

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail_image')) {
            $thumbnailPath = $request->file('thumbnail_image')->store('upload/room_thumbnails', 'public');
        }

        $room = Room::create([
            'title' => $request->input('title'),
            'roomId_number' => $request->input('roomId_number'),
            'room_type_id' => $request->input('room_type'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'room_area' => $request->input('room_area'),
            'max_people' => $request->input('max_people'),
            'image_room' => json_encode($imagePaths),
            'thumbnail_image' => $thumbnailPath,
            'status' => 0,
        ]);

        $currentTime = Carbon::now();
        $from = $currentTime->hour < 14
            ? $currentTime->setHour(14)->setMinute(0)->setSecond(0)->timestamp
            : $currentTime->addDay()->setHour(14)->setMinute(0)->setSecond(0)->timestamp;

        ManageStatusRoom::create([
            'room_id' => $room->id,
            'status' => 1,
            'from' => $from,
            'to' => 0,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Phòng đã được thêm thành công.');
    }

    public function show($id)
    {

        $title = 'Chi tiết phòng';
        $room = Room::findOrFail($id);
        $roomAssets = RoomAsset::with('assetType')->where('room_id', $id)->get();
        $reviews = Review::where('room_id', $id)->get();

        return view(self::VIEW_PATH . __FUNCTION__, compact('room', 'title', 'roomAssets', 'reviews'));
    }

    public function edit($id)
    {

        $title = 'Chỉnh sửa phòng';
        $room = Room::findOrFail($id);
        $roomId = Room::select('id')->orderBy('id', 'DESC')->first();
        $roomId = $roomId ? $roomId->id + 1 : 1;

        $roomTypes = RoomType::all();

        return view(self::VIEW_PATH . __FUNCTION__, compact('room', 'title', 'roomTypes', 'roomId'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $imagePaths = json_decode($room->image_room, true) ?? [];

        if ($request->hasFile('image_room')) {
            foreach ($imagePaths as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $imagePaths = [];
            foreach ($request->file('image_room') as $image) {
                $path = $image->store('upload/rooms', 'public');
                $imagePaths[] = $path;
            }
        }

        $imageRoomData = !empty($imagePaths) ? json_encode($imagePaths) : $room->image_room;
        $thumbnailImagePath = $room->thumbnail_image;

        if ($request->hasFile('thumbnail_image')) {
            if ($room->thumbnail_image) {
                Storage::disk('public')->delete($room->thumbnail_image);
            }
            $thumbnailImagePath = $request->file('thumbnail_image')->store('upload/rooms/thumbnails', 'public');
        }

        $room->update([
            'title' => $request->input('title'),
            'roomId_number' => $request->input('roomId_number'),
            'room_type_id' => $request->input('room_type'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'room_area' => $request->input('room_area'),
            'max_people' => $request->input('max_people'),
            'image_room' => $imageRoomData,
            'thumbnail_image' => $thumbnailImagePath,
        ]);

        return redirect()->route('rooms.show', $room->id)->with('success', 'Phòng đã được cập nhật thành công.');
    }



    /**
     * Summary of destroy
     * Fix khi push 1 ảnh thì không được xóa hết
     *
     * @param \App\Models\Admin\Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lock($roomId)
    {
        $room = Room::find($roomId);
        if (!$room) {
            return redirect()->back()->withErrors(['error' => 'Phòng không tồn tại.']);
        }

        $now = time();
        $uncompletedBookings = Booking::where('room_id', $roomId)
        ->where(function ($query) use ($now) {
            $query->whereIn('status', [2, 3, 4])
                  ->where('check_out_date', '>=', $now);
        })
        ->exists();

        if ($uncompletedBookings) {
            return redirect()->back()->with(['error' => 'Phòng đang có đơn đặt chưa hoàn thành hoặc sắp tới, không thể khóa.']);
        }

        $room->status = 4;
        $room->save();

        return redirect()->back()->with('success', 'Phòng đã được khóa thành công.');
    }


    public function unlock(Room $room)
    {
        if ($room->status === 4) {
            $room->update(['status' => 0]);
            return redirect()->route('rooms.index')->with('success', 'Phòng đã được mở khóa thành công.');
        } else {
            return redirect()->route('rooms.index')->with('error', 'Chỉ có thể mở khóa phòng khi trạng thái là "đã bị khóa".');
        }
    }
}
